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