<?php
function sendResetEmail($to, $resetLink)
{
    // Sujet de l'email
    $subject = "Réinitialisation de votre mot de passe - GUEV";

    // Corps HTML de l'email
    $message = "
        <html><body style='font-family: Arial, sans-serif;'>
            <h2 style='color:#333;'>Bonjour,</h2>
            <p>Vous avez demandé à réinitialiser votre mot de passe sur <strong>GUEV</strong>.</p>
            <p>Cliquez sur le lien ci-dessous pour choisir un nouveau mot de passe :</p>
            <p><a href='$resetLink' style='display:inline-block;padding:10px 20px;background-color:#0a5;color:#fff;text-decoration:none;'>Réinitialiser mon mot de passe</a></p>
            <p>Si vous n'avez pas fait cette demande, ignorez simplement ce message.</p>
            <p>Ce lien expirera dans une heure.</p>
            <br><p>Merci,<br>L'équipe GUEV</p>
        </body></html>
    ";

    // En-têtes pour l'envoi HTML
    $headers = "From: GUEV <no-reply@localhost>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

    // Envoi de l'email
    return mail($to, $subject, $message, $headers);
}
