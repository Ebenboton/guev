<?php
session_start();
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de Confidentialité - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/confidentialite.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="confidentialite-section">
            <div class="container">
                <h1>Politique de Confidentialité</h1>
                <p>Bienvenue sur le site GUEV. La présente Politique de Confidentialité a pour but de vous informer sur la manière dont nous recueillons, utilisons, stockons et protégeons vos données personnelles.</p>
                
                <h2>1. Collecte des informations</h2>
                <p>Nous recueillons des informations lorsque vous naviguez sur notre site ou interagissez avec nos services. Les informations collectées peuvent inclure votre nom, adresse email, données de navigation, et informations de paiement lors des transactions.</p>
                
                <h2>2. Utilisation des informations</h2>
                <p>Les informations collectées sont utilisées pour :</p>
                <ul>
                    <li>Gérer et améliorer nos services</li>
                    <li>Traiter vos commandes et demandes de contact</li>
                    <li>Vous envoyer des mises à jour et des informations promotionnelles (avec votre consentement préalable)</li>
                    <li>Assurer la sécurité de notre site et prévenir la fraude</li>
                </ul>
                
                <h2>3. Partage des informations</h2>
                <p>Nous ne vendons, n'échangeons ni ne transférons vos informations personnelles à des tiers, sauf lorsque cela est nécessaire pour fournir nos services ou lorsque la loi l'exige.</p>
                
                <h2>4. Stockage et sécurité</h2>
                <p>Vos données personnelles sont stockées sur des serveurs sécurisés et ne sont accessibles qu'aux personnes autorisées. Nous prenons des mesures techniques et organisationnelles pour protéger vos données contre tout accès non autorisé, divulgation, modification ou destruction.</p>
                
                <h2>5. Vos droits</h2>
                <p>Conformément à la législation en vigueur, vous disposez d'un droit d'accès, de rectification, d'opposition et de suppression de vos données personnelles. Pour exercer ces droits, veuillez nous contacter via notre formulaire de contact.</p>
                
                <h2>6. Modifications de la Politique de Confidentialité</h2>
                <p>Nous nous réservons le droit de modifier cette Politique de Confidentialité à tout moment. Les modifications seront publiées sur cette page et prendront effet immédiatement après leur mise en ligne.</p>
                
                <h2>7. Contact</h2>
                <p>Pour toute question relative à notre Politique de Confidentialité ou pour exercer vos droits, veuillez nous contacter à l'adresse email suivante : contact@guev.com.</p>
            </div>
        </section>
    </main>
    
    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php $conn->close(); ?>