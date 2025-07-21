<?php
// filepath: c:\wamp64\www\guev\config\traitement-contact.php
session_start();
require_once __DIR__ . '/db.php';

// Vérifier que la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../contact.php?status=error');
    exit();
}

// Vérifier la présence des champs requis
if (
    !isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']) ||
    empty(trim($_POST['name'])) ||
    empty(trim($_POST['email'])) ||
    empty(trim($_POST['subject'])) ||
    empty(trim($_POST['message']))
) {
    header('Location: ../contact.php?status=missing');
    exit();
}

// Récupération et nettoyage des données
$name    = trim($_POST['name']);
$email   = trim($_POST['email']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

// Validation de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../contact.php?status=invalid_email');
    exit();
}

// Préparation de la requête d'insertion dans la table "contact"
$stmt = $conn->prepare("INSERT INTO contact (nom, email, sujet, message, date_envoi) VALUES (?, ?, ?, ?, NOW())");
if (!$stmt) {
    header('Location: ../contact.php?status=error');
    exit();
}

// Lier les paramètres (tous des chaînes de caractères)
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute()) {
    header('Location: ../contact.php?status=success');
} else {
    header('Location: ../contact.php?status=error');
}

$stmt->close();
$conn->close();
exit();
?>