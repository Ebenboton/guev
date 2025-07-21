<?php
session_start();
require_once 'config/db.php';

// Vérifier que l'order_id est fourni
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    header("Location: index.php?message=Commande non trouvée");
    exit();
}
$order_id = intval($_GET['order_id']);

// Récupérer la commande et les produits associés
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

$query = "SELECT p.nom, p.image, pa.quantite, pa.prix, (pa.quantite * pa.prix) as subtotal FROM panier pa INNER JOIN produits p ON pa.id_produit = p.id_produit WHERE pa.id_commande = " . $order_id;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - Commande #<?= htmlspecialchars($order_id) ?></title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/facture.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section class="invoice-section">
            <div class="container">
                <h1>Facture - Commande #<?= htmlspecialchars($order_id) ?></h1>
                <h2>Informations de facturation</h2>
                <p><strong>Nom:</strong> <?= htmlspecialchars($order['billing_nom']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($order['billing_email']) ?></p>
                <p><strong>Adresse:</strong> <?= htmlspecialchars($order['billing_adresse']) ?></p>
                <p><strong>Ville:</strong> <?= htmlspecialchars($order['billing_ville']) ?></p>
                <p><strong>Code postal:</strong> <?= htmlspecialchars($order['billing_codepostal']) ?></p>
                <h2>Détails de la commande</h2>
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nom']) ?></td>
                            <td><?= $item['quantite'] ?></td>
                            <td><?= number_format($item['prix']) ?>FCFA</td>
                            <td><?= number_format($item['subtotal']) ?>FCFA</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h3>Total: <?= number_format($total) ?>FCFA</h3>
            </div>
        </section>
        <!-- Dans facture.php, par exemple après <h1>Facture - Commande #<?= htmlspecialchars($order_id) ?></h1> -->
<p>
    <a href="download-facture.php?order_id=<?= htmlspecialchars($order_id) ?>" class="btn">Télécharger la facture</a>
</p>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php $conn->close(); ?>