<?php
session_start();
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/blog.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php require_once 'header.php';?>

    <main>
        <section class="blog-page">
            <div class="container">
                <h1>Notre Blog</h1>
                <?php
                // Récupération des articles par ordre décroissant par date de création
                $query = "SELECT * FROM articles ORDER BY created_at DESC";
                $result = $conn->query($query);
                if ($result && $result->num_rows > 0) {
                    echo '<div class="articles-grid">';
                    while ($article = $result->fetch_assoc()) {
                        $media   = htmlspecialchars($article['media']);
                        $title   = htmlspecialchars($article['title']);
                        $ext     = strtolower(pathinfo($media, PATHINFO_EXTENSION));
                        echo '<article class="article-card">';
                        
                        echo '<div class="article-media">';
                        if (!empty($media)) {
                            if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                                echo '<video controls>';
                                echo '    <source src="assets/images/articles/' . $media . '" type="video/' . $ext . '">';
                                echo '    Votre navigateur ne supporte pas la vidéo.';
                                echo '</video>';
                            } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                echo '<img src="assets/images/articles/' . $media . '" alt="' . $title . '">';
                            } else {
                                echo '<div class="media-placeholder">Media non pris en charge</div>';
                            }
                        } else {
                            echo '<div class="media-placeholder">Aucun média disponible</div>';
                        }
                        
                        echo '<div class="article-date">';
                        echo '    <span class="day">' . date('d', strtotime($article['created_at'])) . '</span>';
                        echo '    <span class="month">' . date('M', strtotime($article['created_at'])) . '</span>';
                        echo '</div>';
                        echo '</div>'; // Fin article-media
                        
                        echo '<div class="article-content">';
                        echo '    <h3>' . $title . '</h3>';
                        echo '    <p class="article-excerpt">' . substr(strip_tags($article['description']), 0, 150) . '...</p>';
                        echo '    <a href="article.php?id=' . $article['id_article'] . '" class="read-more">Lire l\'article</a>';
                        echo '</div>';
                        
                        echo '</article>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>Aucun article disponible pour le moment.</p>';
                }
                ?>
            </div>
        </section>
    </main>

    <?php require_once 'footer.php';?>

    <script src="assets/js/index.js"></script>
</body>
</html>
<?php $conn->close(); ?>