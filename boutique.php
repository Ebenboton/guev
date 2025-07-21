<?php
session_start();
require_once 'config/db.php';

// Vérification du terme de recherche et récupération des produits en fonction
if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $term = trim($_GET['q']);
    $termLower = strtolower($term);
    
    if (is_numeric($term)) {
        // Recherche par prix exact et vérification du stock
        $query = "SELECT * FROM produits WHERE prix = ? AND quantiteEnStock > 0 ORDER BY created_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("d", $term);
    } else {
        // Recherche dans le nom et la catégorie (insensible à la casse) et vérification du stock
        $query = "SELECT * FROM produits WHERE (LOWER(nom) LIKE CONCAT('%', ?, '%') OR LOWER(categorie) LIKE CONCAT('%', ?, '%')) AND quantiteEnStock > 0 ORDER BY created_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $termLower, $termLower);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($produit = $result->fetch_assoc()) {
        $products[] = $produit;
    }
    $stmt->close();
} else {
    // Affichage de tous les produits disponibles (avec stock > 0)
    $query = "SELECT * FROM produits WHERE quantiteEnStock > 0 ORDER BY created_at DESC";
    $result = $conn->query($query);
    $products = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
<link rel="stylesheet" href="assets/css/header.css">
<link rel="stylesheet" href="assets/css/slider.css">
<link rel="stylesheet" href="assets/css/presentation.css">
<link rel="stylesheet" href="assets/css/product-search.css">
<link rel="stylesheet" href="assets/css/products-search.css">
<link rel="stylesheet" href="assets/css/products.css">
<link rel="stylesheet" href="assets/css/articles.css">
<link rel="stylesheet" href="assets/css/key-figures.css">
<link rel="stylesheet" href="assets/css/testimonials.css">
<link rel="stylesheet" href="assets/css/review-form.css">
<link rel="stylesheet" href="assets/css/final-cta.css">
<link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php require_once 'header.php'; ?>

    <main>
        <section class="product-page">
            <div class="container">
                <?php if (isset($term)): ?>
                    <h1>Résultats de recherche pour "<?= htmlspecialchars($term) ?>"</h1>
                <?php else: ?>
                    <h1>Nos Produits</h1>
                <?php endif; ?>
                <?php if (!empty($products)): ?>
                    <div class="products-grid">
                        <?php foreach ($products as $produit): ?>
                            <div class="product-card">
                                <img src="assets/images/produits/<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>">
                                <h3><?= htmlspecialchars($produit['nom']) ?></h3>
                                <p class="price"><?= number_format($produit['prix']) ?>FCFA</p>
                                <div class="product-actions">
                                    <a href="produit.php?id=<?= $produit['id_produit'] ?>" class="product-btn">Voir le produit</a>
                                    <button class="add-to-cart" data-product-id="<?= $produit['id_produit'] ?>">
                                        <i class="fas fa-shopping-cart"></i> Ajouter
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Aucun produit ne correspond à votre recherche.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-col">
                <h3>GUEV</h3>
                <p>Solutions écologiques innovantes pour un avenir durable.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h3>Liens utiles</h3>
                <ul>
                    <li><a href="apropos.php">À propos</a></li>
                    <li><a href="boutique.php">Boutique</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Informations</h3>
                <ul>
                    <li><a href="cgv.php">CGV</a></li>
                    <li><a href="confidentialite.php">Confidentialité</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Newsletter</h3>
                <p>Abonnez-vous pour recevoir nos actualités.</p>
                <form class="newsletter-form" action="config/newslatter.php" method="POST">
                    <input type="email" name="email" placeholder="Votre email" required>
                    <button type="submit">S'abonner</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; <?= date('Y') ?> GUEV. Tous droits réservés.</p>
        </div>
    </footer>
    <script src="assets/js/main.js"></script>
<script>
// Au chargement de la page, on ramène la page en haut
document.addEventListener('DOMContentLoaded', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            const quantite = 1; // Quantité par défaut
            
            fetch('panier.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id_produit=' + encodeURIComponent(productId) + '&quantite=' + encodeURIComponent(quantite)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Produit ajouté au panier', 'success');
                    // Optionnel : mettre à jour l'affichage du panier sans recharger la page
                    // window.location.reload();
                } else {
                    showNotification('Erreur: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Erreur Ajax:', error);
                showNotification('Une erreur est survenue lors de l\'ajout du produit.', 'error');
            });
        });
    });
});

// Fonction d'affichage d'une notification avec animation
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = 'notification ' + (type || 'success');
    notification.textContent = message;
    
    // Ajout de la notification au body
    document.body.appendChild(notification);
    
    // Petite temporisation pour déclencher l'animation
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Suppression de la notification après 3 secondes
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}
</script>
</body>
</html>
<?php $conn->close(); ?>