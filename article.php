<?php
require_once 'config/db.php';

// Vérifier que l'ID de l'article est fourni dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: blog.php?message=Article non trouvé");
    exit();
}
$article_id = intval($_GET['id']);

// Préparer et exécuter la requête pour récupérer l'article
$stmt = $conn->prepare("SELECT * FROM articles WHERE id_article = ?");
if (!$stmt) {
    die("Erreur SQL : " . $conn->error);
}
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: blog.php?message=Article non trouvé");
    exit();
}
$article = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
     <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/article.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">

</head>
<body>
    <?php include 'header.php'; ?>

    <main class="article-page">
        <div class="container">
            <article>
                <h1><?= htmlspecialchars($article['title']) ?></h1>
                <p class="pub-date"><?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></p>
                <?php if (!empty($article['media'])): 
                    $ext = strtolower(pathinfo($article['media'], PATHINFO_EXTENSION));
                    if (in_array($ext, array('mp4', 'webm', 'ogg'))): ?>
                        <video controls style="max-width: 100%;">
                            <source src="assets/images/articles/<?= htmlspecialchars($article['media']) ?>" type="video/<?= $ext ?>">
                            Votre navigateur ne supporte pas la vidéo.
                        </video>
                    <?php else: ?>
                        <img src="assets/images/articles/<?= htmlspecialchars($article['media']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" style="max-width: 100%;">
                    <?php endif; 
                endif; ?>
                <div class="content">
                    <?= nl2br(htmlspecialchars($article['description'])) ?>
                </div>
            </article>
            <a href="blog.php" class="btn-back">Retour au blog</a>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>