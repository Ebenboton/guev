<?php
// filepath: c:\wamp64\www\guev\config\process-payment.php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    // Selon le moyen de paiement, récupérez d'autres champs (ex : card details ou transaction_id)
    $payment_method = ""; // à déterminer depuis la commande existante
    if(isset($_POST['card_number'])) {
        // Traitement du paiement par carte (simulation)
        $payment_details = [
            'card_number' => trim($_POST['card_number']),
            'expiration' => trim($_POST['expiration']),
            'cvv' => trim($_POST['cvv'])
        ];
    } elseif(isset($_POST['transaction_id'])) {
        // Traitement du paiement par Mobile Money
        $payment_details = [
            'transaction_id' => trim($_POST['transaction_id'])
        ];
    } else {
        $_SESSION['message'] = "Informations de paiement manquantes.";
        header("Location: payment.php");
        exit();
    }

    // Ici, vous pouvez intégrer l'appel à une API de paiement ou simuler le paiement.
    // Pour cet exemple, nous considérons que le paiement est validé.

    // Mise à jour du statut de la commande (par exemple, "paid")
    $stmt = $conn->prepare("UPDATE orders SET status = 'paid' WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    if($stmt->execute()){
        $_SESSION['message'] = "Paiement effectué avec succès.";
        // Redirection vers la facture, par exemple invoice.php?id={$order_id}
        header("Location: invoice.php?id=" . $order_id);
        exit();
    } else {
        $_SESSION['message'] = "Erreur lors du traitement du paiement.";
        header("Location: payment.php");
        exit();
    }
} else {
    header("Location: checkout.php");
    exit();
}
?>