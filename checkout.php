<?php
session_start();
require_once 'config/db.php';

// Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
if (!isset($_SESSION['user'])) {
    header("Location: connexion.php?message=Veuillez vous connecter pour passer la commande");
    exit();
}

// Récupérer le panier de la session
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
require 'vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/commande.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>

</head>
<body>
    <?php include 'header.php'; ?>
    
    <main>
        <section class="checkout-section">
            <div class="container">
                <h1>Checkout</h1>
                <?php if (empty($products)): ?>
                    <p>Votre panier est vide.</p>
                    <a href="boutique.php" class="btn">Retour à la boutique</a>
                <?php else: ?>
                    <div class="order-summary">
                        <h2>Récapitulatif de la commande</h2>
                        <table class="summary-table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Nom</th>
                                    <th>Quantité</th>
                                    <th>Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <img src="assets/images/produits/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['nom']) ?>" width="80">
                                    </td>
                                    <td><?= htmlspecialchars($product['nom']) ?></td>
                                    <td><?= $product['quantity'] ?></td>
                                    <td><?= number_format($product['subtotal']) ?>FCFA</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="order-total">
                            <h3>Total: <?= number_format($total) ?>FCFA</h3>
                        </div>
                    </div>
                    <div class="checkout-form">
                        <h2>Informations de facturation</h2>
                        <!--<form action="config/process-checkout.php" method="POST">-->
                            <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>">
                            <div class="form-group">
                                <label for="nom">Nom complet</label>
                                <input type="text" id="nom" name="nom" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Adresse email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" id="adresse" name="adresse" required>
                            </div>
                           
                            <!--
                            <div class="form-group">
                                <label for="payment_method">Moyen de paiement</label>
                                <select name="payment_method" id="payment_method" required>
                                    <option value="">-- Sélectionnez --</option>
                                    <option value="moov">Mobile Money (Moov)</option>
                                    <option value="mtn">Mobile Money (MTN)</option>
                                    <option value="celtis">Mobile Money (Celtis)</option>
                                    <option value="carte_bancaire">Carte Bancaire</option>
                                </select>
                            </div>
                            -->
                            <div class="form-group">
                                <button id="pay-btn" type="submit" class="btn-checkout kkiapay-button" id="paymentButton">Passer la commande</button>
                                <script type="text/javascript">
                                    FedaPay.init("#pay-btn", { public_key: "pk_live_5inFDDaU7JJZMHh2XEmNfZfB" });
                                </script>
                            </div>
                       <!-- </form>-->
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    
    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php $conn->close(); ?>