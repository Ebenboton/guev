<?php
// filepath: c:\wamp64\www\guev\config\newslatter.php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Échapper l'email pour la requête
        $emailEscaped = $conn->real_escape_string($email);
        
        // Vérifier si l'email est déjà enregistré
        $checkQuery = "SELECT id FROM newsletter WHERE email = '$emailEscaped' LIMIT 1";
        $checkResult = $conn->query($checkQuery);
        
        if ($checkResult && $checkResult->num_rows > 0) {
            $_SESSION['newsletter_message'] = "Vous êtes déjà abonné(e) à notre newsletter.";
            $_SESSION['newsletter_type'] = "info";
            header('Location: ../index.php');
            exit();
        }
        
        // Insérer l'email dans la table newsletter
        $query = "INSERT INTO newsletter (email) VALUES ('$emailEscaped')";
        
        if ($conn->query($query)) {
            $_SESSION['newsletter_message'] = "Merci, vous êtes abonné(e) à notre newsletter avec succès.";
            $_SESSION['newsletter_type'] = "success";
            header('Location: ../index.php');
            exit();
        } else {
            $_SESSION['newsletter_message'] = "Une erreur est survenue lors de votre abonnement.";
            $_SESSION['newsletter_type'] = "error";
            header('Location: ../index.php');
            exit();
        }
    } else {
        $_SESSION['newsletter_message'] = "L'adresse email est invalide.";
        $_SESSION['newsletter_type'] = "error";
        header('Location: ../index.php');
        exit();
    }
}

header('Location: ../index.php');
exit();
?>