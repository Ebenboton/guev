<?php
// filepath: c:\wamp64\www\guev\historique-commandes.php
session_start();
require_once 'config/db.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: connexion.php?message=Veuillez vous connecter");
    exit();
}

$user_id = $_SESSION['user']['id_user'];

// Récupérer les commandes de l'utilisateur connecté
$stmt = $conn->prepare("SELECT * FROM commande WHERE id_user = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while($row = $result->fetch_assoc()){
    $orders[] = $row;
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Commandes - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/historique.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section class="orders-section">
            <div class="container">
                <h1>Historique des Commandes</h1>
                <?php if (empty($orders)): ?>
                    <p>Aucune commande effectuée.</p>
                    <a href="boutique.php" class="btn">Aller à la boutique</a>
                <?php else: ?>
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>ID Commande</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= htmlspecialchars($order['id_commande']); ?></td>
                                    <td><?= number_format($order['total']); ?>FCFA</td>
                                    <td><?= htmlspecialchars($order['status']); ?></td>
                                    <td><?= htmlspecialchars($order['created_at']); ?></td>
                                    <td>
                                        <a href="facture.php?order_id=<?= $order['id_commande']; ?>" class="btn">Voir Facture</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <?php $conn->close(); ?>
</body>
</html>
`````<?php
// filepath: c:\wamp64\www\guev\historique-commandes.php
session_start();
require_once 'config/db.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: connexion.php?message=Veuillez vous connecter");
    exit();
}

$user_id = $_SESSION['user']['id_user'];

// Récupérer les commandes de l'utilisateur connecté
$stmt = $conn->prepare("SELECT * FROM commande WHERE id_user = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while($row = $result->fetch_assoc()){
    $orders[] = $row;
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Commandes - GUEV</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section class="orders-section">
            <div class="container">
                <h1>Historique des Commandes</h1>
                <?php if (empty($orders)): ?>
                    <p>Aucune commande effectuée.</p>
                    <a href="boutique.php" class="btn">Aller à la boutique</a>
                <?php else: ?>
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>ID Commande</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= htmlspecialchars($order['id_commande']); ?></td>
                                    <td><?= number_format($order['total']); ?>FCFA</td>
                                    <td><?= htmlspecialchars($order['status']); ?></td>
                                    <td><?= htmlspecialchars($order['created_at']); ?></td>
                                    <td>
                                        <a href="facture.php?order_id=<?= $order['id_commande']; ?>" class="btn">Voir Facture</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <?php $conn->close(); ?>
</body>
</html>