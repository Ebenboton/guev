<?php
session_start();
require_once 'includes/db.php';

// Initialisation des variables
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    
    if (empty($email)) {
        $error = "Veuillez entrer votre adresse email.";
    } else {
        // Vérifier si l'email existe pour un admin
        $stmt = $conn->prepare("SELECT id_user FROM users WHERE email = ? AND role = 'admin'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows == 1) {
            // Envoyer un email de réinitialisation (à implémenter)
            $success = "Si cet email est enregistré, vous recevrez un lien de réinitialisation.";
        } else {
            // Message générique pour ne pas révéler quels emails existent
            $success = "Si cet email est enregistré, vous recevrez un lien de réinitialisation.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - GUEV</title>
    <link rel="stylesheet" href="./asset/css/connexion.css">
</head>
<body>
    <div class="login-container">
        <h1>Réinitialisation du mot de passe</h1>
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success-message"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <form action="forgot_password.php" method="POST">
            <div class="form-group">
                <label for="email">Adresse email administrateur</label>
                <input type="email" name="email" id="email" required>
            </div>
            <button type="submit" class="btn-submit">Envoyer le lien</button>
        </form>
        <div class="back-to-login">
            <a href="login.php">Retour à la connexion</a>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>