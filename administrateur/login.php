<?php
session_start();
require_once 'includes/db.php';


// Si l'administrateur est déjà connecté, rediriger vers le dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php');
    exit();
}

// Initialisation des variables
$error = "";
$remaining_time = 0;
$wait_time_seconds = 30 * 60; // 30 minutes en secondes

// Gestion des tentatives de connexion
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 3) {
    $last_attempt = $_SESSION['last_attempt_time'];
    $current_time = time();
    if (($current_time - $last_attempt) < $wait_time_seconds) {
        $remaining_time = $wait_time_seconds - ($current_time - $last_attempt);
        $error = "Trop de tentatives. Réessayez dans " . gmdate("i:s", $remaining_time) . " minutes.";
    } else {
        // Réinitialiser les tentatives après 30 minutes
        unset($_SESSION['login_attempts']);
        unset($_SESSION['last_attempt_time']);
    }
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $remaining_time == 0) {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if (empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        // On recherche dans la table "users" uniquement les utilisateurs ayant le rôle "admin"
        $stmt = $conn->prepare("SELECT id_user, name, email, password, role FROM users WHERE email = ? AND role = 'admin'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows == 1) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                // Connexion réussie, initialiser la session administrateur
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin'] = $admin;
                
                // Réinitialiser les tentatives de connexion
                unset($_SESSION['login_attempts']);
                unset($_SESSION['last_attempt_time']);
                
                header("Location: index.php");
                exit();
            } else {
                $error = "Identifiants incorrects.";
                incrementLoginAttempts();
            }
        } else {
            $error = "Identifiants incorrects.";
            incrementLoginAttempts();
        }
        $stmt->close();
    }
}

function incrementLoginAttempts() {
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 1;
    } else {
        $_SESSION['login_attempts']++;
    }
    $_SESSION['last_attempt_time'] = time();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur - GUEV</title>
    <link rel="stylesheet" href="./asset/css/connexion.css">
</head>
<body>
    <div class="login-container">
        <h1>Connexion Administrateur</h1>
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" required value="<?= htmlspecialchars($email ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn-submit">Se connecter</button>
            <div class="forgot-password-link">
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=forgot">Mot de passe oublié ?</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?>