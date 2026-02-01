<?php
session_start();
$token = $_GET['token'] ?? '';
$email = $_GET['email'] ?? '';

if (empty($token) || empty($email)) {
    $_SESSION['error'] = "Lien invalide ou incomplet.";
    header("Location: mot-de-passe-oublie.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
</head>

<body>
    <h2>Réinitialisez votre mot de passe</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color:red"><?= $_SESSION['error'];
                                unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <p style="color:green"><?= $_SESSION['success'];
                                unset($_SESSION['success']); ?></p>
    <?php endif; ?>

    <form action="config/update-password.php" method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">

        <label for="password">Nouveau mot de passe :</label><br>
        <input type="password" id="password" name="password" placeholder="Nouveau mot de passe" required><br><br>

        <label for="confirm_password">Confirmez le mot de passe :</label><br>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmez" required><br><br>

        <button type="submit">Réinitialiser</button>
    </form>
</body>

</html>