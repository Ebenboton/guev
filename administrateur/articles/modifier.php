<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Vérifier et récupérer l'ID de l'article depuis l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}
$article_id = intval($_GET['id']);

// Récupérer les données de l'article
$query = "SELECT * FROM articles WHERE id_article = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}
$article = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Modifier l'Article</title>
    <link rel="stylesheet" href="../../assets/css/modifier.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/menus.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/menu.php'; ?>

    <main class="admin-content">
        <div class="container">
            <h1>Modifier l'Article</h1>
            <form action="traitement-modifier.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($article['id_article']) ?>">
                <div class="form-group">
                    <label for="title">Titre de l'article</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Contenu de l'article</label>
                    <textarea id="description" name="description" rows="10" required><?= htmlspecialchars($article['description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="media">Image d'illustration (laisser vide pour ne pas modifier)</label>
                    <input type="file" id="media" name="media" accept="image/*, video/*, pdf/*">
                </div>
                <button type="submit" class="btn-submit">Mettre à jour l'article</button>
            </form>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>