<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Vérifier et récupérer l'ID du produit depuis l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_produit = intval($_GET['id']);

// Récupérer les données du produit
$query = "SELECT * FROM produits WHERE id_produit = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_produit);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}
$produit = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Modifier un Produit</title>
    <link rel="stylesheet" href="../asset/css/modifier-produit.css">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    

    <main class="admin-content">
        <div class="container">
            <h1>Modifier le Produit</h1>
            <form action="traitement-modifier.php" method="POST" enctype="multipart/form-data">
                <!-- Champ caché pour l'ID du produit -->
                <input type="hidden" name="id_produit" value="<?= htmlspecialchars($produit['id_produit']) ?>">
                
                <div class="form-group">
                    <label for="nom">Nom du produit</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description du produit</label>
                    <textarea id="description" name="description" rows="5" required><?= htmlspecialchars($produit['description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="prix">Prix</label>
                    <input type="number" id="prix" name="prix" step="0.01" value="<?= htmlspecialchars($produit['prix']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="quantiteEnStock">Quantité en stock</label>
                    <input type="number" id="quantiteEnStock" name="quantiteEnStock" value="<?= htmlspecialchars($produit['quantiteEnStock']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie</label>
                    <input type="text" id="categorie" name="categorie" value="<?= htmlspecialchars($produit['categorie']) ?>">
                </div>
                <div class="form-group">
                    <label for="image">Image du produit (laisser vide pour ne pas modifier)</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <?php if (!empty($produit['image'])): ?>
                        <div class="current-image">
                            <p>Image actuelle:</p>
                            <img src="../../assets/images/produits/<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>" style="max-width:100px;">
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn-submit">Mettre à jour le produit</button>
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