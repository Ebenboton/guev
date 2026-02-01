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
    <title>Administration - Ajouter un Produit</title>
   <link rel="stylesheet" href="../asset/css/ajouter-produit.css">
    <link rel="stylesheet" href="../asset/css/header1.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    

    <main class="admin-content">
        <div class="container">
            <h1>Ajouter un Produit</h1>
            <form action="traitement-ajouter.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom">Nom du produit</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="description">Description du produit</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="prix">Prix</label>
                    <input type="number" id="prix" name="prix" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="quantiteEnStock">Quantité en stock</label>
                    <input type="number" id="quantiteEnStock" name="quantiteEnStock" required>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie</label>
                    <input type="text" id="categorie" name="categorie">
                </div>
                <div class="form-group">
                    <label for="image">Image du produit (facultatif)</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn-submit">Ajouter le produit</button>
            </form>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>