<?php
session_start();
// Connexion à la base de données
require_once 'config/db.php';

// Récupération des 6 derniers produits
$produitsQuery = "SELECT * FROM produits ORDER BY created_at DESC LIMIT 6";
$produitsResult = $conn->query($produitsQuery);

// Récupération des 3 derniers articles pour la section "Actualités & Conseils Écologiques"
$articlesQuery = "SELECT * FROM articles ORDER BY created_at DESC LIMIT 3";
$articlesResult = $conn->query($articlesQuery);

// Récupération de tous les avis (affichés en ordre décroissant)
$avisQuery = "SELECT * FROM avis ORDER BY date_creation DESC LIMIT 3";
$avisResult = $conn->query($avisQuery);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GUEV - Solutions Écologiques Innovantes</title>
    <meta name="description" content="Découvrez les solutions écologiques GUEV pour une vie plus durable. Cuisinières économiques et produits respectueux de l'environnement.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
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
    <!-- Barre de navigation -->
   <?php include"header.php"; ?>

    <!-- Slider Bannière -->
    <section class="hero-slider">
        <div class="slider-container">
            <!-- Slide 1 -->
            <div class="slide active">
                <div class="slide-image" style="background-image: url('assets/images/pd2.jpg');"></div>
                <div class="slide-content">
                    <h2>Énergie Verte, Avenir Durable</h2>
                    <p>Découvrez nos solutions écologiques pour réduire votre empreinte carbone</p>
                    <a href="boutique.php" class="cta-btn">Explorer nos produits</a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="slide">
                <div class="slide-image" style="background-image: url('assets/images/pd2.jpg');"></div>
                <div class="slide-content">
                    <h2>Innovation au Service de la Planète</h2>
                    <p>Des technologies propres pour un quotidien plus respectueux de l'environnement</p>
                    <a href="contact.php" class="cta-btn">Nous contactez</a>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="slide">
                <div class="slide-image" style="background-image: url('assets/images/pd3.avif');"></div>
                <div class="slide-content">
                    <h2>Économisez en Préservant</h2>
                    <p>Jusqu'à 60% d'économie d'énergie avec nos produits high-tech écologiques</p>
                    <a href="produit.php" class="cta-btn">Découvrir la GUEV Cooker</a>
                </div>
            </div>
            <!-- Contrôles du slider -->
            <button class="slider-control prev"><i class="fas fa-chevron-left"></i></button>
            <button class="slider-control next"><i class="fas fa-chevron-right"></i></button>
            <!-- Pagination -->
            <div class="slider-pagination">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    <!-- Section Présentation -->
    <section class="presentation">
        <div class="container">
            <h2>Qui sommes-nous ?</h2>
            <p>GUEV est une entreprise engagée dans le développement de solutions écologiques innovantes pour améliorer le quotidien tout en préservant notre planète. Notre mission est de rendre accessible à tous des technologies durables et économiques.</p>
            <div class="mission-vision">
                <div class="card">
                    <i class="fas fa-bullseye"></i>
                    <h3>Notre Mission</h3>
                    <p>Réduire la consommation de bois et les émissions de CO2 grâce à des produits de cuisson efficaces et accessibles.</p>
                </div>
                <div class="card">
                    <i class="fas fa-eye"></i>
                    <h3>Notre Vision</h3>
                    <p>Un monde où chaque foyer a accès à des solutions énergétiques durables qui améliorent la qualité de vie.</p>
                </div>
                <div class="card">
                    <i class="fas fa-chart-line"></i>
                    <h3>Notre Impact</h3>
                    <p>Plus de 10,000 cuisinières distribuées, réduisant la consommation de bois de 60% en moyenne.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Barre de recherche -->
    <section class="product-search">
        <div class="container">
            <form class="search-form" action="./config/search.php" method="GET">
                 <input type="text" name="q" placeholder="Rechercher un produit..." class="search-input">
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </section>

    <!-- Produits phares -->
    <section class="featured-products">
        <div class="container">
            <h2>Nos Produits Phares</h2>
            <div class="products-grid">
                <?php while($produit = $produitsResult->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="assets/images/produits/<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>">
                    <h3><?= htmlspecialchars($produit['nom']) ?></h3>
                    <p class="price"><?= number_format($produit['prix']) ?>FCFA </p>
                    <div class="product-actions">
                        <a href="produit.php?id=<?= $produit['id_produit'] ?>" class="product-btn">Voir le produit</a>
                        <button class="add-to-cart" data-product-id="<?= $produit['id_produit'] ?>">
                            <i class="fas fa-shopping-cart"></i> Ajouter
                        </button>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="center-btn">
                <a href="boutique.php" class="cta-btn secondary">Voir tous nos produits</a>
            </div>
        </div>
    </section>

    <!-- Section Articles Récents (Actualités & Conseils Écologiques) -->
    <section class="recent-articles">
        <div class="container">
            <h2>Actualités & Conseils Écologiques</h2>
            <p class="section-subtitle">Découvrez nos derniers articles sur l'énergie durable et les pratiques écologiques</p>
            <div class="articles-grid">
                <?php while($article = $articlesResult->fetch_assoc()): ?>
                <article class="article-card">
                    <div class="article-image">
                        <?php if(!empty($article['media'])): 
                            $media = $article['media'];
                            $ext = strtolower(pathinfo($media, PATHINFO_EXTENSION));
                            if(in_array($ext, ['mp4', 'webm'])): ?>
                                <video controls style="width:100%; max-height:300px;">
                                    <source src="assets/images/articles/<?= htmlspecialchars($media) ?>" type="video/<?= $ext ?>">
                                    Votre navigateur ne supporte pas la lecture de vidéos.
                                </video>
                            <?php else: ?>
                                <img src="assets/images/articles/<?= htmlspecialchars($media) ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="default-image">
                                <p><?= substr(strip_tags($article['description']), 0, 150) ?>...</p>
                            </div>
                        <?php endif; ?>
                        <div class="article-date">
                            <span class="day"><?= date('d', strtotime($article['created_at'])) ?></span>
                            <span class="month"><?= date('M', strtotime($article['created_at'])) ?></span>
                        </div>
                    </div>
                    <div class="article-content">
                        <h3><?= htmlspecialchars($article['title']) ?></h3>
                        <p class="article-excerpt"><?= substr(strip_tags($article['description']), 0, 150) ?>...</p>
                        <a href="article.php?id=<?= $article['id_article'] ?>" class="read-more">
                            Lire l'article <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
            <div class="center-btn">
                <a href="blog.php" class="cta-btn secondary">Voir tous les articles</a>
            </div>
        </div>
    </section>

    <!-- Chiffres clés -->
    <section class="key-figures">
        <div class="container">
            <h2>Notre Impact en Chiffres</h2>
            <div class="figures-grid">
                <div class="figure-card">
                    <span class="number" data-count="10000">0</span>
                    <p>Cuisinières écologiques distribuées</p>
                </div>
                <div class="figure-card">
                    <span class="number" data-count="60">0</span><span>%</span>
                    <p>Réduction de consommation de bois</p>
                </div>
                <div class="figure-card">
                    <span class="number" data-count="5000">0</span><span>+</span>
                    <p>Familles impactées positivement</p>
                </div>
                <div class="figure-card">
                    <span class="number" data-count="75">0</span><span>%</span>
                    <p>Réduction d'émissions de CO2</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Témoignages -->
     <section class="testimonials">
        <div class="container">
            <div class="reviews-list">
                <h3>Les avis de nos clients</h3>
                <?php if($avisResult && $avisResult->num_rows > 0): ?>
                    <?php while($avis = $avisResult->fetch_assoc()): ?>
                        <div class="avis-card">
                            <div class="avis-header">
                                <h4><?= htmlspecialchars($avis['nom']) ?></h4>
                                <div class="avis-rating">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $avis['note']): ?>
                                            <i class="fas fa-star"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="avis-comment"><?= nl2br(htmlspecialchars($avis['commentaire'])) ?></p>
                            <span class="avis-date"><?= date('d/m/Y H:i', strtotime($avis['date_creation'])) ?></span>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Aucun avis pour le moment.</p>
                <?php endif; ?>
            </div>
            <div class="center-btn">
                <a href="avis.php" class="cta-btn secondary">Voir tous les avis</a>
            </div>
        </div>
    </section>

    <!-- Formulaire d'avis -->
    <section class="review-form-section">
        <div class="container">
            <h2>Donnez votre avis</h2>
            <p class="subtitle">Votre expérience nous intéresse ! Partagez votre opinion sur nos produits.</p>
            <?php if(isset($_SESSION['user'])): ?>
            <form id="avisForm" class="review-form" action="config/traitement-avis.php" method="POST">
                <div class="form-group">
                    <label for="nom">Votre nom*</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="email">Votre email*</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Produit concerné*</label>
                    <select name="produit" required>
                        <option value="">Sélectionnez un produit</option>
                        <?php 
                        $produitsForAvis = $conn->query("SELECT id_produit, nom FROM produits");
                        while($produit = $produitsForAvis->fetch_assoc()): ?>
                            <option value="<?= $produit['id_produit'] ?>"><?= htmlspecialchars($produit['nom']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Note*</label>
                    <div class="rating">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star1" name="rating" value="1" required>
                        <label for="star1"><i class="fas fa-star"></i></label>
                    </div>
                </div>
                <div class="form-group full-width">
                    <label for="commentaire">Votre avis*</label>
                    <textarea id="commentaire" name="commentaire" rows="5" required></textarea>
                </div>
                <div class="form-group full-width">
                    <div class="consent">
                        <input type="checkbox" id="consent" name="consent" required>
                        <label for="consent">J'accepte que mon avis soit publié sur le site GUEV*</label>
                    </div>
                </div>
                <button type="submit" class="submit-btn">Envoyer mon avis</button>
            </form>
            <?php else: ?>
                <p class="login-message">Veuillez vous <a href="connexion.php">connecter</a> pour laisser un avis.</p>
            <?php endif; ?>
            <div id="thankYouMessage" class="thank-you-message" style="display: none;">
                <i class="fas fa-check-circle"></i>
                <h3>Merci pour votre avis !</h3>
                <p>Votre commentaire a été soumis avec succès. Il sera publié après modération.</p>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="final-cta">
        <div class="container">
            <h2>Prêt à faire la différence ?</h2>
            <p>Rejoignez notre communauté et contribuez à un avenir plus durable.</p>
            <div class="cta-buttons">
                <a href="boutique.php" class="cta-btn">Acheter nos produits</a>
                <a href="contact.php" class="cta-btn secondary">Nous contacter</a>
            </div>
        </div>
    </section>

<!-- Section Partenaires -->
<section class="partners-section">
    <div class="container">
        <h2>Nos Partenaires Institutionnels</h2>
        <div class="partners-slider">
            <div class="partners-track">
                <!-- Partenaire 1 -->
                <div class="partner-card">
                    <div class="partner-logo">
                        <img src="assets/images1.jpg" alt="Ministère de l'Eau et des Mines">
                    </div>
                    <div class="partner-info">
                        <h3>MINISTÈRE DE L'EAU ET DES MINES</h3>
                        <p>RÉPUBLIQUE DU BÉNIN</p>
                    </div>
                </div>
                
                <!-- Partenaire 2 -->
                <div class="partner-card">
                    <div class="partner-logo">
                        <img src="assets/images2.jpg" alt="Ministère du Cadre de Vie">
                    </div>
                    <div class="partner-info">
                        <h3>MINISTÈRE DU CADRE DE VIE</h3>
                        <p>ET DU DÉVELOPPEMENT DURABLE</p>
                        <p>RÉPUBLIQUE DU BÉNIN</p>
                    </div>
                </div>
                
                <!-- Partenaire 3 -->
                <div class="partner-card">
                    <div class="partner-logo">
                        <img src="assets/images3.jpg" alt="Ministère de l'Industrie">
                    </div>
                    <div class="partner-info">
                        <h3>MINISTÈRE DE L'INDUSTRIE</h3>
                        <p>ET DU COMMERCE</p>
                        <p>RÉPUBLIQUE DU BÉNIN</p>
                    </div>
                </div>
                
                <!-- Partenaire 4 -->
                <div class="partner-card">
                    <div class="partner-logo">
                        <img src="assets/images4.jpg" alt="Ministère de l'Enseignement">
                    </div>
                    <div class="partner-info">
                        <h3>MINISTÈRE DE L'ENSEIGNEMENT SUPÉRIEUR</h3>
                        <p>ET DE LA RECHERCHE SCIENTIFIQUE</p>
                        <p>RÉPUBLIQUE DU BÉNIN</p>
                    </div>
                </div>
                
                <!-- Ajoutez d'autres partenaires de la même manière -->
            </div>
        </div>
        <div class="slider-controls">
            <button class="prev-partner"><i class="fas fa-chevron-left"></i></button>
            <button class="next-partner"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
</section>




    <!-- Pied de page -->
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
                    <li><a href="boutique.php">Nos produits</a></li>
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

                 <?php
                if (isset($_SESSION['newsletter_message'])):
                    $type = ($_SESSION['newsletter_type'] == "success") ? "notification-success" : (($_SESSION['newsletter_type'] == "error") ? "notification-error" : "notification-info");
                ?>
                <div class="<?= $type; ?>">
                    <?= htmlspecialchars($_SESSION['newsletter_message']); ?>
                </div>
                <?php
            // Réinitialisation du message
            unset($_SESSION['newsletter_message'], $_SESSION['newsletter_type']);
           endif;
          ?>
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

    <!-- Script pour le bouton Ajouter au panier via Ajax -->
    <script>
    document.querySelectorAll('.add-to-cart').forEach(function(button) {
        button.addEventListener('click', function(){
            var productId = this.getAttribute('data-product-id');
            // Quantité par défaut = 1
            fetch('panier.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id_produit=' + encodeURIComponent(productId) + '&quantite=1'
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if(data.success) {
                    alert('Produit ajouté au panier');
                    // Optionnel : mettre à jour le compteur du panier ou recharger la page
                    location.reload();
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(function(error) {
                console.error('Erreur Ajax:', error);
                alert('Une erreur s\'est produite lors de l\'ajout.');
            });
        });
    });
    </script>
    <script src="assets/js/key-figures.js"></script>
    <script src="assets/js/testimonials.js"></script>
    <script src="assets/js/slider.js"></script>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/products.js"></script>
    <script src="assets/js/articles.js"></script>   
    <script src="assets/js/product-search.js"></script>
</body>
</html>
<?php $conn->close(); ?>
