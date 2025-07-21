<?php
// filepath: c:\wamp64\www\guev\administrateur\produits\index.php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Récupérer tous les produits (en tenant compte de la structure de la table produits)
$query = "SELECT * FROM produits ORDER BY created_at DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion des Produits</title>
    <link rel="stylesheet" href="../asset/css/produit.css">
    <link rel="stylesheet" href="../asset/css/header1.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php //include '../includes/menus.php'; ?>

    <main class="admin-content">
        <div class="container">
            <h1>Liste des Produits</h1>
            <a href="ajouter.php" class="btn-submit">Ajouter un Produit</a>
            <?php if ($result && $result->num_rows > 0): ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Image</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($produit = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($produit['id_produit']) ?></td>
                            <td><?= htmlspecialchars($produit['nom']) ?></td>
                            <td>
                                <?php if (!empty($produit['image'])): ?>
                                    <img src="../../assets/images/produits/<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>" style="max-width:100px;">
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td><?= number_format($produit['prix']) ?> FCFA</td>
                            <td><?= htmlspecialchars($produit['quantiteEnStock']) ?></td>
                            <td><?= date('d/m/Y', strtotime($produit['created_at'])) ?></td>
                            <td>
                                <a href="modifier.php?id=<?= $produit['id_produit'] ?>" class="btn-edit">Modifier</a>
                                <a href="supprimer.php?id=<?= $produit['id_produit'] ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun produit trouvé.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>