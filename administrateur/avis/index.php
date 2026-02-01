<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Récupérer tous les avis avec les bons noms de colonnes
$query = "SELECT id AS id_avis, nom, note AS rating, commentaire, date_creation FROM avis ORDER BY date_creation DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion des Avis</title>
    <link rel="stylesheet" href="../asset/css/avis.css">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php //include '../includes/menu.php'; ?>

    <main class="admin-content">
        <div class="container">
            <h1>Liste des Avis</h1>
            <?php if ($result && $result->num_rows > 0): ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($avis = $result->fetch_assoc()): 
                            // Vérification et valeurs par défaut
                            $id_avis = $avis['id_avis'] ?? 0;
                            $nom = $avis['nom'] ?? 'Non renseigné';
                            $rating = $avis['rating'] ?? 0;
                            $commentaire = $avis['commentaire'] ?? '';
                            $date = isset($avis['date_creation']) ? date('d/m/Y H:i', strtotime($avis['date_creation'])) : 'Date inconnue';
                        ?>
                            <tr>
                                <td><?= htmlspecialchars((string)$id_avis) ?></td>
                                <td><?= htmlspecialchars($nom) ?></td>
                                <td>
                                    <div class="star-rating">
                                        <?php 
                                        // Afficher les étoiles pour la note (sur 5)
                                        $fullStars = floor($rating);
                                        $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
                                        $emptyStars = 5 - $fullStars - $halfStar;
                                        
                                        // Étoiles pleines
                                        for ($i = 0; $i < $fullStars; $i++) {
                                            echo '★';
                                        }
                                        
                                        // Demi-étoile
                                        if ($halfStar) {
                                            echo '½';
                                        }
                                        
                                        // Étoiles vides
                                        for ($i = 0; $i < $emptyStars; $i++) {
                                            echo '☆';
                                        }
                                        ?>
                                        <span class="rating-value">(<?= $rating ?>/5)</span>
                                    </div>
                                </td>
                                <td><?= !empty($commentaire) ? nl2br(htmlspecialchars($commentaire)) : 'Aucun commentaire' ?></td>
                                <td><?= $date ?></td>
                                <td>
                                    <a href="supprimer.php?id=<?= (int)$id_avis ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-results">Aucun avis trouvé.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>