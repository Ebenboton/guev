<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Vérifier et récupérer l'ID du panier depuis l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_panier = intval($_GET['id']);

// Récupérer les données du panier
$query = "SELECT * FROM panier WHERE id_panier = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_panier);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php?message=Panier non trouvé");
    exit();
}

$panier = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Panier</title>
   <link rel="stylesheet" href="../assets/css/details-panier.css">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    

    <main class="admin-content">
        <div class="container">
            <h1>Détails du Panier</h1>
            <div class="details">
                <p><strong>ID Panier :</strong> <?= htmlspecialchars($panier['id_panier']) ?></p>
                <p><strong>ID Utilisateur :</strong> <?= htmlspecialchars($panier['id_user']) ?></p>
                <p><strong>ID Produit :</strong> <?= htmlspecialchars($panier['id_produit']) ?></p>
                <p><strong>Quantité :</strong> <?= htmlspecialchars($panier['quantite']) ?></p>
                <p><strong>Date de création :</strong> <?= date('d/m/Y H:i', strtotime($panier['created_at'])) ?></p>
            </div>
            <a href="index.php" class="btn-back">Retour à la liste des paniers</a>
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