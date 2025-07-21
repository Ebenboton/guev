<?php
session_start();
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/apropos.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <!-- Inclusion de l'en-tête -->
    <?php include 'header.php'; ?>

    <main>
        <!-- Section Héros -->
        <section class="about-hero">
            <div class="container">
                <h1>À propos de GUEV</h1>
                <p>GUEV Ecological Venture est une entreprise sociale et solidaire (Société À Responsabilité Limitée) de droit béninois, à impact africain et à utilité globale Positionnée dans les énergies renouvelables, l’ingénierie verte et les technologies écoresponsables centrées sur l’humain, elle oeuvre à catalyser des solutions durables, au profit des Peuples, de la Planète et la Postérité.</p>
                <p> Les solutions vertes produites et promues par GUEV sont technologiquement fiables et économiquement viables, et génèrent des effets positifs avérés sur l'environnement, le climat, la santé, l'économie locale, la performance des systèmes agricoles et alimentaires, et la société, en l’occurrence sur l’autonomisation des femmes et la résilience des communautés rurales ainsi que sur la création d’emplois décents</p>
            </div>
        </section>

        <!-- Section Notre Histoire -->
        <section class="about-history">
            <div class="container">
                <h2>Notre Histoire</h2>
                <p>Fondée en 2020, GUEV est née de la volonté de réduire l'empreinte écologique tout en améliorant le quotidien de chacun. Depuis nos débuts, nous n'avons cessé d'innover afin d'offrir des produits de qualité qui respectent l'environnement.</p>
            </div>
        </section>

        <!-- Section Mission et Vision -->
        <section class="about-mission-vision">
            <div class="container">
                <h2>Notre Mission</h2>
                <p>Produire et commercialiser des innovations technologiques industrielles inclusives et vertes via des procédés et stratégies créatrices d’opportunités d’emplois, surtout en milieu rural.</p>
                <h2>Notre Vision</h2>
                <p>Contribuer à accélérer la mise en place d’une infrastructure de développement économique à faible empreinte carbone, à fort potentiel de création d’emploi, et résilient aux changements climatiques ».</p>
            </div>
        </section>

        <!-- Section Équipe -->
        <section class="about-team">
            <div class="container">
                <h2>Notre Équipe</h2>
                <p>Notre équipe est composée d'experts passionnés dans les domaines de la technologie, de l'environnement et du design. Ensemble, nous travaillons chaque jour pour améliorer vos conditions de vie en vous proposant des solutions écologiques à la pointe de l'innovation.</p>
            </div>
        </section>
    </main>

    <!-- Inclusion du pied de page -->
    <?php include 'footer.php'; ?>
    <script src="assets/js/index.js"></script>
</body>
</html>
