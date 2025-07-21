<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Ajouter un Article</title>
    <link rel="stylesheet" href="../asset/css/ajouter.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/menus.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/menu.php'; ?>

    <main class="admin-content">
        <div class="container">
            <h1>Ajouter un Article</h1>
            <!-- Affichage d'un message de retour si présent -->
            <?php if (isset($_GET['message'])): ?>
                <p class="message"><?= htmlspecialchars($_GET['message']) ?></p>
            <?php endif; ?>
            <form action="traitement-ajouter.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Titre de l'article</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Contenu de l'article</label>
                    <textarea id="description" name="description" rows="10" required></textarea>
                </div>
                <div class="form-group">
                    <label for="media">Fichier média (Image ou Vidéo, facultatif)</label>
                    <input type="file" id="media" name="media" accept="image/*,video/*">
                </div>
                <button type="submit" class="btn-submit">Ajouter l'article</button>
            </form>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>