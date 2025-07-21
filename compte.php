<?php
session_start();
require_once 'config/db.php';

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['user'])) {
    header("Location: connexion.php");
    exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - GUEV</title>
     <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/compte.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="account-section">
            <div class="container">
                <h1>Bienvenue, <?= htmlspecialchars($user['name']) ?></h1>
                <p>Email : <?= htmlspecialchars($user['email']) ?></p>
                <p>Rôle : <?= htmlspecialchars($user['role']) ?></p>
                
                <!-- Zone supplémentaire pour la gestion du compte -->
                <div class="account-actions">
                    <a href="historique-commandes.php" class="btn-submit">Voir mon historique de commandes</a>
                    <a href="deconnexion.php" class="btn-submit">Se déconnecter</a>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>
