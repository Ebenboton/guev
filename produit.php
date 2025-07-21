<?php
session_start();
require_once 'config/db.php';

// Vérifier que l'ID du produit est fourni dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: boutique.php?message=Produit non trouvé");
    exit();
}
$product_id = intval($_GET['id']);

// Récupérer les données du produit
$stmt = $conn->prepare("SELECT * FROM produits WHERE id_produit = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: boutique.php?message=Produit non trouvé");
    exit();
}
$product = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['nom']) ?></title>
     <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/produit-item.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="product-page">
        <div class="container">
            <h1><?= htmlspecialchars($product['nom']) ?></h1>
            <div class="product-details">
                <?php if (!empty($product['image'])): ?>
                    <img src="assets/images/produits/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['nom']) ?>" style="max-width:100%;">
                <?php endif; ?>
                <div class="product-info">
                    <p class="price"><?= number_format($product['prix']) ?> FCFA</p>
                    <p class="availability"><?= ($product['quantiteEnStock'] > 0) ? "En stock" : "Rupture de stock" ?></p>
                    <div class="description">
                        <?= nl2br(htmlspecialchars($product['description'])) ?>
                    </div>
                    <!-- Formulaire d'ajout au panier avec quantité par défaut à 1 -->
                    <form id="addToCartForm" action="panier.php" method="POST">
                        <input type="hidden" name="id_produit" value="<?= htmlspecialchars($product['id_produit']) ?>">
                        <input type="hidden" name="quantite" value="1">
                        <button type="submit" class="add-to-cart-btn">Ajouter au panier</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script>
        // Intercepter la soumission du formulaire pour ajouter au panier via Ajax
        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const formData = new URLSearchParams(new FormData(form));
            fetch('panier.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: formData.toString()
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Produit ajouté au panier');
                    // Vous pouvez mettre à jour le compteur du panier ici si souhaité
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erreur Ajax:', error);
                alert('Une erreur est survenue lors de l\'ajout du produit.');
            });
        });
    </script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>