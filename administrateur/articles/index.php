<?php
session_start();
require_once '../includes/db.php';

$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Récupérer tous les articles
$query = "SELECT id_article, title, media, description, created_at FROM articles ORDER BY created_at DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion des Articles</title>
    <link rel="stylesheet" href="../asset/css/articles.css">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php //include '../includes/menus.php'; ?>

    <main class="admin-content">
        <div class="container">
            <h1>Liste des Articles</h1>
            <a href="ajouter.php" class="btn-submit">Ajouter un Article</a>
            <?php if($result && $result->num_rows > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Média</th>
                        <th>Description</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($article = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($article['id_article']) ?></td>
                        <td><?= htmlspecialchars($article['title']) ?></td>
                        <td>
                            <?php if(!empty($article['media'])): ?>
                                <img src="../../assets/images/articles/<?= htmlspecialchars($article['media']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" style="max-width:100px;">
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?= nl2br(htmlspecialchars($article['description'])) ?></td>
                        <td><?= date('d/m/Y', strtotime($article['created_at'])) ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $article['id_article'] ?>" class="btn-edit">Modifier</a>
                            <a href="supprimer.php?id=<?= $article['id_article'] ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>Aucun article trouvé.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>