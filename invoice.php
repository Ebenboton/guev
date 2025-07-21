<?php
// filepath: c:\wamp64\www\guev\invoice.php
session_start();
require_once 'config/db.php';

if (!isset($_GET['id'])) {
    header("Location: boutique.php");
    exit();
}

$order_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$order || $order['status'] !== 'paid') {
    $_SESSION['message'] = "Commande non trouvée ou non réglée.";
    header("Location: boutique.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - Commande #<?= $order['id'] ?></title>
    <link rel="stylesheet" href="assets/css/invoice.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section class="invoice-section">
            <div class="container">
                <h1>Facture - Commande #<?= $order['id'] ?></h1>
                <p>Date de commande: <?= date('d/m/Y', strtotime($order['created_at'])) ?></p>
                <p>Nom: <?= htmlspecialchars($order['nom']) ?></p>
                <p>Email: <?= htmlspecialchars($order['email']) ?></p>
                <p>Adresse: <?= htmlspecialchars($order['adresse']) ?>, <?= htmlspecialchars($order['ville']) ?>, <?= htmlspecialchars($order['code_postal']) ?></p>
                <p>Moyen de paiement: <?= htmlspecialchars($order['payment_method']) ?></p>
                <h3>Total payé: €<?= number_format($order['total'], 2) ?></h3>
                <a href="assets/invoices/invoice_<?= $order['id'] ?>.pdf" class="btn-download" target="_blank">Télécharger la facture</a>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php $conn->close(); ?>