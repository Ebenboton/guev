<?php
require_once 'db.php';
session_start();

$token = $_POST['token'] ?? '';
$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if (empty($token) || empty($email) || empty($pass) || empty($confirm)) {
    $_SESSION['error'] = "Tous les champs sont obligatoires.";
    header("Location: ../reset-password.php?token=$token&email=$email");
    exit;
}

if ($pass !== $confirm) {
    $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
    header("Location: ../reset-password.php?token=$token&email=$email");
    exit;
}

// Vérifier si le token est valide et non expiré
$stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = ? AND email = ? AND expires_at > NOW()");
$stmt->bind_param("ss", $token, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Le lien de réinitialisation est invalide ou expiré.";
    header("Location: ../mot-de-passe-oublie.php");
    exit;
}

$row = $result->fetch_assoc();
$email = $row['email'];

// Hasher le nouveau mot de passe
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

// Mettre à jour le mot de passe
$update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
if (!$update) {
    $_SESSION['error'] = "Erreur de mise à jour du mot de passe : " . $conn->error;
    header("Location: ../reset-password.php?token=$token&email=$email");
    exit;
}
$update->bind_param("ss", $hashedPassword, $email);
$update->execute();

// Supprimer le token utilisé
$deleteStmt = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
if ($deleteStmt) {
    $deleteStmt->bind_param("s", $email);
    $deleteStmt->execute();
    $deleteStmt->close();
}

$_SESSION['success'] = "Mot de passe mis à jour avec succès. Vous pouvez maintenant vous connecter.";
header("Location: ../connexion.php");
exit;
