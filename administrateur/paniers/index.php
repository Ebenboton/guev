<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Récupérer tous les paniers
// On suppose que la table "panier" possède les colonnes suivantes :
// id_panier, id_user, id_produit, quantite, created_at
$query = "SELECT * FROM panier ORDER BY created_at DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion des Paniers</title>
    <link rel="stylesheet" href="../asset/css/panier.css">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    

    <main class="admin-content">
        <div class="container">
            <h1>Liste des Paniers</h1>
            <?php if ($result && $result->num_rows > 0): ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Utilisateur</th>
                            <th>ID Produit</th>
                            <th>Quantité</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($panier = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($panier['id_panier']) ?></td>
                            <td><?= htmlspecialchars($panier['id_user']) ?></td>
                            <td><?= htmlspecialchars($panier['id_produit']) ?></td>
                            <td><?= htmlspecialchars($panier['quantite']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($panier['created_at'])) ?></td>
                            <td>
                                <a href="details.php?id=<?= $panier['id_panier'] ?>" class="btn-view">Détails</a>
                                <a href="supprimer.php?id=<?= $panier['id_panier'] ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce panier ?');">Supprimer</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun panier trouvé.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>