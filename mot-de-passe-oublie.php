<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        .form-wrapper {
            max-width: 400px;
            margin: auto;
        }

        .alert-success {
            background-color: #e6ffe6;
            color: #006600;
            padding: 10px;
            margin-bottom: 10px;
        }

        .alert-error {
            background-color: #ffe6e6;
            color: #cc0000;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="form-wrapper">
        <h2>Réinitialiser le mot de passe</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form action="config/send-reset-link.php" method="POST">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required>
            <button type="submit" class="btn">Envoyer le lien</button>
        </form>

        <?php if (isset($_SESSION['retry_email'])): ?>
            <form action="config/send-reset-link.php" method="POST" style="margin-top: 10px;">
                <input type="hidden" name="email" value="<?= htmlspecialchars($_SESSION['retry_email']) ?>">
                <button type="submit" class="btn">Renvoyer l’email</button>
            </form>
            <?php unset($_SESSION['retry_email']); ?>
        <?php endif; ?>
    </div>
</body>

</html>