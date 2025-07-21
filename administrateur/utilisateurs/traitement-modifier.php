<?php
// filepath: c:\wamp64\www\guev\administrateur\utilisateurs\traitement-modifier.php
session_start();

// On s'assure que la méthode est POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: application/json');
    echo json_encode(["success" => false, "error" => "Méthode non autorisée"]);
    exit();
}

// Vérifier la présence des champs requis
if (
    !isset($_POST['id_user'], $_POST['name'], $_POST['email'], $_POST['role']) ||
    empty(trim($_POST['id_user'])) ||
    empty(trim($_POST['name'])) ||
    empty(trim($_POST['email'])) ||
    empty(trim($_POST['role']))
) {
    header('Content-Type: application/json');
    echo json_encode(["success" => false, "error" => "Champs manquants"]);
    exit();
}

$id    = intval($_POST['id_user']);
$name  = trim($_POST['name']);
$email = trim($_POST['email']);
$role  = trim($_POST['role']);

// Validation de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Content-Type: application/json');
    echo json_encode(["success" => false, "error" => "Email invalide"]);
    exit();
}

// Inclusion du fichier de connexion (vérifiez que le chemin est correct)
require_once '../includes/db.php';

// Préparation de la requête de mise à jour
$stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id_user = ?");
if (!$stmt) {
    header('Content-Type: application/json');
    echo json_encode(["success" => false, "error" => "Erreur de préparation de la requête"]);
    exit();
}

$stmt->bind_param("sssi", $name, $email, $role, $id);

if ($stmt->execute()) {
    header('Content-Type: application/json');
    if ($stmt->affected_rows === 0) {
        echo json_encode(["success" => true, "info" => "no_change"]);
    } else {
        echo json_encode(["success" => true]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(["success" => false, "error" => "Erreur lors de la mise à jour"]);
}

$stmt->close();
$conn->close();
exit();
?>