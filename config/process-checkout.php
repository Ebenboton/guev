<?php
// filepath: c:\wamp64\www\guev\config\process-checkout.php
session_start();
require_once 'db.php';
require_once __DIR__ . '/src/cinetpay.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupération et validation des informations de facturation
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $adresse = trim($_POST['adresse']);
    //$payment_method = trim($_POST['payment_method']);
    $total = floatval($_POST['total']);

    if(empty($nom) || empty($email) || empty($adresse) || empty($ville) || empty($code_postal) || empty($payment_method)) {
        $_SESSION['message'] = "Veuillez renseigner tous les champs de facturation.";
        header("Location: checkout.php");
        exit();
    }

    // Insertion de la commande dans la table 'commande'
    // Les colonnes 'payment_status', 'status' et 'created_at' seront gérées par leurs valeurs par défaut
    $stmt = $conn->prepare("INSERT INTO commande (id_user, total, billing_nom, billing_email, billing_adresse, billing_ville, billing_codepostal, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Supposons que l'utilisateur est connecté et son identifiant est stocké dans $_SESSION['user']['id']
    // Sinon, vous pouvez utiliser NULL ou une autre valeur par défaut
    $user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : NULL;
    
    $stmt->bind_param("idssssss", $user_id, $total, $nom, $email, $adresse, $ville, $code_postal, $payment_method);
    
    if($stmt->execute()){
        // Récupération de l'ID de la commande créée
        $_SESSION['order_id'] = $stmt->insert_id;
    } else {
        $_SESSION['message'] = "Erreur lors de la validation de la commande.";
        header("Location: checkout.php");
        exit();
    }
    $stmt->close();

    // Rediriger vers la page de paiement
    header("Location: payment.php");
    exit();
} else {
    header("Location: checkout.php");
    exit();
}
?>