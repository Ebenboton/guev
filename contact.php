<?php
session_start();
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
   
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <!-- Section combinée Contact -->
        <section class="contact-combined">
            <div class="contact-info">
                <h2>Nos Coordonnées</h2>
                <p><strong>Adresse :</strong> 123 Rue Exemple, 75000 Paris, France</p>
                <p><strong>Téléphone :</strong> +33 1 23 45 67 89</p>
                <p><strong>Email :</strong> contact@guev.com</p>
                <p><strong>Horaires :</strong> Du lundi au vendredi, 9h00 - 18h00</p>
            </div>

            <div class="contact-form">
                <h1>Contactez-nous</h1>
                <p>Pour toute question ou demande d'information, veuillez remplir le formulaire ci-dessous.</p>
                <form action="config/traitement-contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Objet</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Envoyer</button>
                </form>
            </div>
           
        </section>
        
        <!-- Section Google Map pour la Localisation Géographique -->
        <section class="map-section container">
            <h2>Nous Trouver</h2>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9994507655345!2d2.2922928156743884!3d48.85837307928761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66ef3dd2a8bfb%3A0xb8f8ebf65dabe26a!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1600000000000!5m2!1sfr!2sfr" 
                        width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </section>
    </main>
    
    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php $conn->close(); ?>