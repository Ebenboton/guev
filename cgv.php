<?php
session_start();
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conditions Générales de Vente - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/cgv.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="cgv-section">
            <div class="container">
                <h1>Conditions Générales de Vente</h1>
                <p>Bienvenue sur le site GUEV. Les présentes Conditions Générales de Vente (CGV) s'appliquent à toutes commandes passées sur ce site. Veuillez les lire attentivement avant toute commande.</p>
                
                <h2>1. Objet</h2>
                <p>Les présentes CGV ont pour objet de définir les modalités et conditions dans lesquelles GUEV vend ses produits aux clients.</p>
                
                <h2>2. Prix</h2>
                <p>Tous les prix sont indiqués en euros, toutes taxes comprises (TTC) et incluant la participation aux frais de traitement et d'expédition.</p>
                
                <h2>3. Commande</h2>
                <p>La commande est validée dès son envoi par le client sur le site. GUEV confirme la réception par email.</p>
                
                <h2>4. Paiement</h2>
                <p>Le règlement s’effectue en ligne par carte bancaire ou tout autre moyen de paiement proposé sur le site. Le paiement est sécurisé.</p>
                
                <h2>5. Livraison</h2>
                <p>Les produits sont livrés à l'adresse indiquée par le client lors de la commande. Les délais de livraison sont indicatifs et varient selon les destinations.</p>
                
                <h2>6. Droit de rétractation</h2>
                <p>Conformément à la réglementation en vigueur, le client dispose d’un délai de 14 jours pour exercer son droit de rétractation sans avoir à justifier de motifs, à l'exception des produits personnalisés.</p>
                
                <h2>7. Garanties</h2>
                <p>Tous les produits bénéficient de la garantie légale de conformité et de la garantie contre les vices cachés, permettant au client de renvoyer le produit défectueux.</p>
                
                <h2>8. Responsabilité</h2>
                <p>GUEV ne saurait être tenu responsable des dommages directs ou indirects pouvant survenir du fait de l’achat des produits, sauf en cas de faute prouvée.</p>
                
                <h2>9. Droit applicable</h2>
                <p>Les présentes CGV sont régies par le droit français. En cas de litige, les tribunaux français seront seuls compétents.</p>
                
                <h2>10. Modifications des CGV</h2>
                <p>GUEV se réserve le droit de modifier les présentes CGV à tout moment. Les CGV applicables sont celles en vigueur au moment de la commande.</p>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php $conn->close(); ?>