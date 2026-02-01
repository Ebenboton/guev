<?php
session_start();
require_once '../config/db.php'; // Connexion à la base
require_once '../config/functions.php'; // Fonctions : generateToken(), sendResetEmail()

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Active les erreurs SQL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère l'email (normal ou renvoi)
    $email = isset($_POST['resend_email']) ? trim($_POST['resend_email']) : trim($_POST['email']);

    if (empty($email)) {
        $_SESSION['error'] = "Veuillez entrer une adresse email.";
        header("Location: ../mot-de-passe-oublie.php");
        exit;
    }

    // Vérifie que l'email existe dans la table users
    $stmt = $conn->prepare("SELECT id_user FROM users WHERE email = ?");
    if (!$stmt) {
        $_SESSION['error'] = "Erreur interne. Veuillez réessayer.";
        header("Location: ../mot-de-passe-oublie.php");
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    /*if ($stmt->num_rows === 0) {
        $_SESSION['error'] = "Aucun compte trouvé avec cet email.";
        header("Location: ../mot-de-passe-oublie.php");
        exit;
    }*/

    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    // Supprime les anciens tokens pour cet email
    $deleteStmt = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
    if ($deleteStmt) {
        $deleteStmt->bind_param("s", $email);
        $deleteStmt->execute();
        $deleteStmt->close();
    }

    // Génère un nouveau token
    $token = generateToken(64);
    $expires_at = date("Y-m-d H:i:s", time() + 3600); // Token valide 1h

    // Insère dans la table password_resets
    $insertStmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
    if (!$insertStmt) {
        $_SESSION['error'] = "Erreur serveur. Impossible de générer un lien.";
        header("Location: ../mot-de-passe-oublie.php");
        exit;
    }

    $insertStmt->bind_param("sss", $email, $token, $expires_at);
    $insertStmt->execute();
    $insertStmt->close();

    // Création du lien de réinitialisation
    $resetLink = "http://localhost/test/reset-password.php?token=" . urlencode($token) . "&email=" . urlencode($email);

    $sujet = "Réinitialisation de votre mot de passe";
    $message = "
        <p>Bonjour,</p>
        <p>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
        <p><a href='$resetLink'>$resetLink</a></p>
        <p>Ce lien expirera dans 1 heure.</p>
    ";

    // Envoi de l'email
    $mailSent = sendResetEmail($email,  $sujet, $message);


    if ($mailSent) {
        $_SESSION['success'] = "Un email de réinitialisation a été envoyé à votre adresse.";
    } else {
        $_SESSION['error'] = "L'email n'a pas pu être envoyé. Cliquez sur le bouton ci-dessous pour réessayer.";
        $_SESSION['resend'] = true;
        $_SESSION['last_email'] = $email;
    }

    header("Location: ../mot-de-passe-oublie.php");
    exit;
} else {
    header("Location: ../mot-de-passe-oublie.php");
    exit;
}
