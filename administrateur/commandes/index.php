<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Modifier la requête pour joindre la table users et récupérer le nom de l'utilisateur
$query = "SELECT c.*, u.name
          FROM commande c
          INNER JOIN users u ON c.id_user = u.id_user
          ORDER BY c.created_at DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion des Commandes</title>
    <link rel="stylesheet" href="../asset/css/commande.css">
    <link rel="stylesheet" href="../asset/css/header1.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php //include '../includes/menu.php'; ?>

    <main class="admin-content">
        <div class="container">
            <h1>Liste des Commandes</h1>
            <?php if ($result && $result->num_rows > 0): ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Utilisateur</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($commande = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($commande['id_commande']) ?></td>
                            <td><?= htmlspecialchars($commande['name']) ?></td>
                            <td><?= number_format($commande['total']) ?> FCFA</td>
                            <td><?= date('d/m/Y H:i', strtotime($commande['created_at'])) ?></td>
                            <td><?= htmlspecialchars($commande['status']) ?></td>
                            <td>
                                <a href="details.php?id=<?= $commande['id_commande'] ?>" class="btn-view">Détails</a>
                                <a href="supprimer.php?id=<?= $commande['id_commande'] ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">Supprimer</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune commande trouvée.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>
