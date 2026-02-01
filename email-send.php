<?php if (isset($_SESSION['error'])): ?>
    <div class="alert-error" style="background-color: #ffe6e6; color: #cc0000; padding: 10px; margin: 10px 0;">
        <?= htmlspecialchars($_SESSION['error']); ?>
    </div>
<?php unset($_SESSION['error']);
endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert-success" style="background-color: #e6ffe6; color: #006600; padding: 10px; margin: 10px 0;">
        <?= htmlspecialchars($_SESSION['success']); ?>
    </div>
<?php unset($_SESSION['success']);
endif; ?>

<?php if (isset($_SESSION['retry_email'])): ?>
    <form action="config/send-reset-link.php" method="POST" style="margin-top: 15px;">
        <input type="hidden" name="email" value="<?= htmlspecialchars($_SESSION['retry_email']) ?>">
        <button type="submit" class="btn" style="padding: 8px 12px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
            Vous n’avez pas reçu l’email ? Cliquez ici pour le renvoyer
        </button>
    </form>
<?php unset($_SESSION['retry_email']);
endif; ?>