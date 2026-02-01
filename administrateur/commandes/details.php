<?php
// filepath: c:\wamp64\www\guev\administrateur\commandes\details.php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Vérifier que l'ID de la commande est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?message=Commande non spécifiée");
    exit();
}

$order_id = intval($_GET['id']);

// Récupération des informations de la commande et de l'utilisateur associé
$stmt = $conn->prepare("SELECT c.*, u.name as user_name, u.email as user_email FROM commande c INNER JOIN users u ON c.id_user = u.id_user WHERE c.id_commande = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();
if ($order_result->num_rows === 0) {
    header("Location: index.php?message=Commande non trouvée");
    exit();
}
$order = $order_result->fetch_assoc();
$stmt->close();

// Récupération des produits de la commande
$query = "SELECT p.nom, p.image, pa.quantite, pa.prix, (pa.quantite * pa.prix) as subtotal
          FROM panier pa
          INNER JOIN produits p ON pa.id_produit = p.id_produit
          WHERE pa.id_commande = " . $order_id;
$result = $conn->query($query);

$items = [];
$total = 0;
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
        $total += $row['subtotal'];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la commande - GUEV</title>
   <link rel="stylesheet" href="../asset/css/detail-commande.css">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    
    <main class="admin-content">
        <div class="container">
            <h1>Détails de la commande #<?= htmlspecialchars($order['id_commande']) ?></h1>
            <section class="order-info">
                <h2>Informations de la commande</h2>
                <p><strong>Utilisateur :</strong> <?= htmlspecialchars($order['user_name']) ?> (<?= htmlspecialchars($order['user_email']) ?>)</p>
                <p><strong>Total :</strong> <?= number_format($order['total']) ?> FCFA</p>
                <p><strong>Statut :</strong> <?= htmlspecialchars($order['status']) ?></p>
                <p><strong>Date :</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
                <p><strong>Moyen de paiement :</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
                <p><strong>Statut du paiement :</strong> <?= htmlspecialchars($order['payment_status']) ?></p>
            </section>
            
            <section class="order-items">
                <h2>Produits commandés</h2>
                <?php if (empty($items)): ?>
                    <p>Aucun produit trouvé pour cette commande.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['nom']) ?></td>
                                <td><?= $item['quantite'] ?></td>
                                <td><?= number_format($item['prix']) ?> FCFA</td>
                                <td><?= number_format($item['subtotal']) ?> FCFA</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Total</th>
                                <th><?= number_format($total) ?> FCFA</th>
                            </tr>
                        </tfoot>
                    </table>
                <?php endif; ?>
            </section>
            
            <div class="actions">
                <a href="index.php" class="btn">Retour à la liste</a>
            </div>
        </div>
    </main>
    
    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
