<?php
session_start();
require_once 'config/db.php';

// Traiter l'ajout au panier via une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produit']) && isset($_POST['quantite'])) {
    header('Content-Type: application/json');
    
    $id_produit = intval($_POST['id_produit']);
    $quantite   = intval($_POST['quantite']);
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Ajouter ou mettre à jour le produit dans le panier
    if (isset($_SESSION['cart'][$id_produit])) {
        $_SESSION['cart'][$id_produit] += $quantite;
    } else {
        $_SESSION['cart'][$id_produit] = $quantite;
    }
    
    echo json_encode(['success' => true]);
    exit(); // Terminer l'exécution pour ne pas afficher le reste de la page
}

// --- Suite du code pour l'affichage de la page (requête GET) ---
// Récupérer le contenu du panier depuis la session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$products = [];
$total = 0;

if (!empty($cart)) {
    $ids = array_keys($cart);
    $ids_list = implode(',', array_map('intval', $ids));
    $query = "SELECT * FROM produits WHERE id_produit IN ($ids_list)";
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $row['quantity'] = isset($cart[$row['id_produit']]) ? intval($cart[$row['id_produit']]) : 0;
            $row['subtotal'] = $row['prix'] * $row['quantity'];
            $products[] = $row;
            $total += $row['subtotal'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/panier.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="cart-section">
            <div class="container">
                <h1>Mon Panier</h1>
                <?php if (empty($products)): ?>
                    <p>Votre panier est vide.</p>
                <?php else: ?>
                    <form action="config/update-cart.php" method="POST">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Nom</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Sous-total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td>
                                            <img src="assets/images/produits/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['nom']) ?>" width="80">
                                        </td>
                                        <td><?= htmlspecialchars($product['nom']) ?></td>
                                        <td><?= number_format($product['prix']) ?>FCFA</td>
                                        <td>
                                            <input type="number" name="quantities[<?= $product['id_produit'] ?>]" value="<?= $product['quantity'] ?>" min="1">
                                        </td>
                                        <td><?= number_format($product['subtotal']) ?>FCFA</td>
                                        <td>
                                            <a href="config/remove-from-cart.php?id=<?= $product['id_produit'] ?>" class="btn-remove">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="cart-summary">
                            <h3>Total: <?= number_format($total) ?>FCFA</h3>
                            <button type="submit" class="btn-update">Mettre à jour le panier</button>
                            <a href="checkout.php" class="btn-checkout">Passer à la commande</a>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php $conn->close(); ?>