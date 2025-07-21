<?php
// filepath: c:\wamp64\www\guev\download-facture.php
session_start();
require_once 'config/db.php';
require_once __DIR__ . '/vendor/autoload.php'; // Assurez-vous que le chemin correspond à votre autoloader Composer

// Vérifier que l'order_id est fourni
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die('Commande non spécifiée.');
}
$order_id = intval($_GET['order_id']);

// Récupérer la commande et les produits associés
$stmt = $conn->prepare("SELECT c.*, u.name as user_name, u.email as user_email FROM commande c INNER JOIN users u ON c.id_user = u.id_user WHERE c.id_commande = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();
if ($order_result->num_rows === 0) {
    die('Commande non trouvée.');
}
$order = $order_result->fetch_assoc();
$stmt->close();

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

// Préparation du contenu HTML pour le PDF
ob_start();
?>
<html>
<head>
  <style>
      body { font-family: DejaVu Sans, sans-serif; }
      table { width: 100%; border-collapse: collapse; }
      table, th, td { border: 1px solid #000; }
      th, td { padding: 8px; text-align: left; }
  </style>
</head>
<body>
    <h1>Facture - Commande #<?= htmlspecialchars($order_id) ?></h1>
    <h2>Informations de facturation</h2>
    <p><strong>Nom :</strong> <?= htmlspecialchars($order['billing_nom']) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($order['billing_email']) ?></p>
    <p><strong>Adresse :</strong> <?= htmlspecialchars($order['billing_adresse']) ?></p>
    <p><strong>Ville :</strong> <?= htmlspecialchars($order['billing_ville']) ?></p>
    <p><strong>Code postal :</strong> <?= htmlspecialchars($order['billing_codepostal']) ?></p>
    <h2>Détails de la commande</h2>
    <table>
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
                <td>€<?= number_format($item['prix'], 2) ?></td>
                <td>€<?= number_format($item['subtotal'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3>Total : €<?= number_format($total, 2) ?></h3>
</body>
</html>
<?php
$html = ob_get_clean();

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
// 'D' force le téléchargement, 'I' l'affiche dans le navigateur
$mpdf->Output('facture_commande_' . $order_id . '.pdf', 'D');
exit();
?>