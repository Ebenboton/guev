<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure PHPMailer (chemin relatif depuis ce fichier)
require_once __DIR__ . '/../lib/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../lib/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../lib/PHPMailer/src/Exception.php';

function generateToken($length = 64)
{
    return bin2hex(random_bytes($length / 2));
}

function sendResetEmail($email, $sujet, $message)
{
    $mail = new PHPMailer(true);

    try {
        // Paramètres serveur
        $mail->SMTPDebug = 0; // Désactiver les logs de debug pour éviter les erreurs PSR-3
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'botonben7@gmail.com'; // ⚠️ Ton email
        $mail->Password   = 'zowjmuobtsfcpqak'; // ⚠️ Mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // (Optionnel, si ton PHP a des problèmes de certificat SSL)
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
        
        // Destinataires
        $mail->setFrom('botonben7@gmail.com', 'GUEV');
        $mail->addAddress($email);

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = $sujet ;
        $mail->Body    = $message;


        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Erreur d'envoi d'email : " . $mail->ErrorInfo);
        return false;
    }
}
