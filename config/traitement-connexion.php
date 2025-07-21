<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier la présence des champs requis
    if (
        !isset($_POST['email'], $_POST['password']) ||
        empty(trim($_POST['email'])) ||
        empty(trim($_POST['password']))
    ) {
        header('Location: ../connexion.php?login=missing');
        exit();
    }

    // Récupération et nettoyage des données
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../connexion.php?login=invalid_email');
        exit();
    }

    // Préparation de la requête pour récupérer l'utilisateur
    $stmt = $conn->prepare("SELECT id_user, name, email, password, role FROM users WHERE email = ?");
    if(!$stmt) {
        header('Location: ../connexion.php?login=error');
        exit();
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Vérifier si l'utilisateur existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_user, $name, $emailDB, $passwordHash, $role);
        $stmt->fetch();

        // Vérifier le mot de passe
        if (password_verify($password, $passwordHash)) {
            // Connexion réussie, initialiser la session
            $_SESSION['user'] = [
                'id_user' => $id_user,
                'name'    => $name,
                'email'   => $emailDB,
                'role'    => $role
            ];
            // Redirection vers la page index après connexion réussie
            header('Location: ../index.php?login=success');
            exit();
        } else {
            header('Location: ../connexion.php?login=invalid_password');
            exit();
        }
    } else {
        header('Location: ../connexion.php?login=no_user');
        exit();
    }
    $stmt->close();
}

header('Location: ../connexion.php');
exit();
?>