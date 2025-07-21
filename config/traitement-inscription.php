<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier la présence des champs requis
    if (
        !isset($_POST['name'], $_POST['email'], $_POST['password']) ||
        empty(trim($_POST['name'])) ||
        empty(trim($_POST['email'])) ||
        empty(trim($_POST['password']))
    ) {
        header('Location: ../connexion.php?inscription=missing');
        exit();
    }
    
    // Récupération et nettoyage des données
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../connexion.php?inscription=invalid_email');
        exit();
    }
    
    // Hachage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Préparation de la requête d'insertion (role par défaut : 'client')
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, created_at) VALUES (?, ?, ?, 'client', NOW())");
    if (!$stmt) {
        header('Location: ../connexion.php?inscription=error');
        exit();
    }
    
    $stmt->bind_param("sss", $name, $email, $hashedPassword);
    
    if ($stmt->execute()) {
        // Connexion automatique du client après inscription (optionnel)
        $_SESSION['user'] = [
            'id_user' => $stmt->insert_id,
            'name'    => $name,
            'email'   => $email,
            'role'    => 'client'
        ];
        header('Location: ../compte.php?inscription=success');
        exit();
    } else {
        header('Location: ../connexion.php?inscription=error');
        exit();
    }
    
    $stmt->close();
}

header('Location: ../connexion.php');
exit();
?>