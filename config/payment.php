<?php
// filepath: c:\wamp64\www\guev\config\payment.php
session_start();
require_once 'db.php';

if (!isset($_SESSION['order_id'])) {
    header("Location: checkout.php");
    exit();
}

$order_id = $_SESSION['order_id'];
// Récupérer les informations de la commande depuis la table "commande"
$stmt = $conn->prepare("SELECT * FROM commande WHERE id_commande = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$order) {
    $_SESSION['message'] = "Commande introuvable.";
    header("Location: checkout.php");
    exit();
}

$payment_method = $order['payment_method'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/commande.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section class="payment-section">
            <div class="container">
                <h1>Paiement de la commande #<?= htmlspecialchars($order['id_commande']) ?></h1>
                <?php if ($payment_method == "carte_bancaire"): ?>
                    <h2>Paiement par Carte Bancaire</h2>
                    <!-- Formulaire de paiement direct par carte bancaire -->
                    <form id="cardPaymentForm" action="config/process-payment.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id_commande']) ?>">
                        <div class="form-group">
                            <label for="card_number">Numéro de carte</label>
                            <input type="text" id="card_number" name="card_number" required>
                        </div>
                        <div class="form-group">
                            <label for="expiration">Date d'expiration (MM/AA)</label>
                            <input type="text" id="expiration" name="expiration" placeholder="MM/AA" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" required>
                        </div>
                        <!-- Bouton de paiement direct -->
                        <button type="submit" class="btn-submit">Payer maintenant</button>
                    </form>
                <?php else: ?>
                    <h2>Paiement Mobile Money</h2>
                    <p>Veuillez saisir votre numéro de mobile pour effectuer le paiement via <?= htmlspecialchars($payment_method) ?>.</p>
                    <!-- Formulaire de paiement direct par Mobile Money -->
                    <form id="mobilePaymentForm" action="config/process-payment.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id_commande']) ?>">
                        <div class="form-group">
                            <label for="mobile_number">Numéro de mobile</label>
                            <input type="text" id="mobile_number" name="mobile_number" required>
                        </div>
                        <!-- Bouton de confirmation du paiement -->
                        <button type="submit" class="btn-submit">Confirmer le paiement</button>
                    </form>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
    <?php if ($payment_method != "carte_bancaire"): ?>
    <script>
        // Validation du numéro de mobile pour Mobile Money
        const mobileForm = document.getElementById('mobilePaymentForm');
        if(mobileForm){
            mobileForm.addEventListener('submit', function(e) {
                const mobileInput = document.getElementById('mobile_number');
                const mobileNumber = mobileInput.value.trim();
                // Exemple de validation : numéro de 10 chiffres commençant par 0
                const regex = /^0[0-9]{9}$/;
                if (!regex.test(mobileNumber)) {
                    alert("Veuillez saisir un numéro de mobile valide (10 chiffres, commençant par 0).");
                    e.preventDefault();
                }
            });
        }
    </script>
    <?php endif; ?>
</body>
</html>
<?php $conn->close(); ?>