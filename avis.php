<?php
// filepath: c:\wamp64\www\guev\avis.php
session_start();
require_once 'config/db.php';

// Récupération de tous les avis, triés par date de création décroissante
$avisQuery = "SELECT * FROM avis ORDER BY date_creation DESC";
$avisResult = $conn->query($avisQuery);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les Avis - GUEV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/avis.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="reviews-page">
        <div class="container">
            <h1>Tous les Avis de Nos Clients</h1>
            <?php if($avisResult && $avisResult->num_rows > 0): ?>
                <div class="reviews-list">
                    <?php while($avis = $avisResult->fetch_assoc()): ?>
                        <div class="avis-card">
                            <div class="avis-header">
                                <h4><?= htmlspecialchars($avis['nom']) ?></h4>
                                <div class="avis-rating">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $avis['note']): ?>
                                            <i class="fas fa-star"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="avis-comment"><?= nl2br(htmlspecialchars($avis['commentaire'])) ?></p>
                            <span class="avis-date"><?= date('d/m/Y H:i', strtotime($avis['date_creation'])) ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Aucun avis n'a été publié pour le moment.</p>
            <?php endif; ?>
            <div class="center-btn">
                <a href="index.php" class="cta-btn secondary">Retour à l'accueil</a>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <?php $conn->close(); ?>
</body>
</html>
```<?php
// filepath: c:\wamp64\www\guev\avis.php
session_start();
require_once 'config/db.php';

// Récupération de tous les avis, triés par date de création décroissante
$avisQuery = "SELECT * FROM avis ORDER BY date_creation DESC";
$avisResult = $conn->query($avisQuery);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les Avis - GUEV</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="reviews-page">
        <div class="container">
            <h1>Tous les Avis de Nos Clients</h1>
            <?php if($avisResult && $avisResult->num_rows > 0): ?>
                <div class="reviews-list">
                    <?php while($avis = $avisResult->fetch_assoc()): ?>
                        <div class="avis-card">
                            <div class="avis-header">
                                <h4><?= htmlspecialchars($avis['nom']) ?></h4>
                                <div class="avis-rating">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $avis['note']): ?>
                                            <i class="fas fa-star"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="avis-comment"><?= nl2br(htmlspecialchars($avis['commentaire'])) ?></p>
                            <span class="avis-date"><?= date('d/m/Y H:i', strtotime($avis['date_creation'])) ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Aucun avis n'a été publié pour le moment.</p>
            <?php endif; ?>
            <div class="center-btn">
                <a href="index.php" class="cta-btn secondary">Retour à l'accueil</a>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <?php $conn->close(); ?>
</body>
</html>