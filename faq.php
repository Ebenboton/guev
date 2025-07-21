<?php
session_start();
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - GUEV</title>
     <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/faq.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="faq-section">
            <div class="container">
                <h1>Foire aux Questions (FAQ)</h1>
                
                <div class="faq-item">
                    <h2>Comment passer une commande ?</h2>
                    <p>Pour passer une commande, sélectionnez vos produits, ajoutez-les à votre panier, et suivez le processus de paiement.</p>
                </div>
                
                <div class="faq-item">
                    <h2>Quels modes de paiement acceptez-vous ?</h2>
                    <p>Nous acceptons les paiements par carte bancaire, PayPal et d’autres moyens de paiement sécurisés proposés sur notre site.</p>
                </div>
                
                <div class="faq-item">
                    <h2>Quels sont les délais de livraison ?</h2>
                    <p>Les délais de livraison varient selon votre lieu de résidence, généralement entre 3 et 7 jours ouvrables.</p>
                </div>
                
                <div class="faq-item">
                    <h2>Puis-je retourner un produit ?</h2>
                    <p>Oui, vous disposez d'un délai de 14 jours pour retourner un produit non personnalisé et dans son état d'origine.</p>
                </div>
                
                <div class="faq-item">
                    <h2>Comment contacter le service client ?</h2>
                    <p>Vous pouvez nous contacter via notre formulaire de contact, par email à contact@guev.com ou par téléphone pendant les heures d'ouverture indiquées sur le site.</p>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php $conn->close(); ?>