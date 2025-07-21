<?php
// filepath: c:\wamp64\www\guev\administrateur\utilisateurs\index.php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Gestion des messages de succès/erreur
$success_message = $_GET['success'] ?? '';
$error_message = $_GET['error'] ?? '';

// Récupérer tous les utilisateurs
$query = "SELECT id_user, name, email, role, created_at FROM users ORDER BY created_at DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="../asset/css/utilisateur.css">
    <link rel="stylesheet" href="../asset/css/header1.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">

    <!-- Script pour nettoyer l'URL et gérer la suppression -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // Nettoyer l'URL après un message de succès
        if(urlParams.has('success')) {
            history.replaceState(null, '', window.location.pathname);
        }
        
        // Gestion des confirmations de suppression
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                if(!confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            });
        });
    });
    </script>
</head>
<body>
    <?php include '../includes/header.php'; ?>
   <!-- <?php include '../includes/menus.php'; ?>-->

    <main class="admin-content">
        <div class="container">
            <h1>Liste des Utilisateurs</h1>
            
            <?php if ($success_message): ?>
                <div class="alert success"><?= htmlspecialchars($success_message) ?></div>
            <?php endif; ?>
            
            <?php if ($error_message): ?>
                <div class="alert error"><?= htmlspecialchars($error_message) ?></div>
            <?php endif; ?>

            <?php if ($result && $result->num_rows > 0): ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id_user']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                            <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                            <td class="actions-cell">
                                <a href="modifier.php?id=<?= $user['id_user'] ?>" class="btn-edit">Modifier</a>
                                <a href="supprimer.php?id=<?= $user['id_user'] ?>" class="btn-delete">Supprimer</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-results">Aucun utilisateur trouvé.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../assets/js/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>