<?php
// filepath: c:\wamp64\www\guev\administrateur\utilisateurs\modifier.php
session_start();
require_once '../includes/db.php';

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Vérifier et récupérer l'ID de l'utilisateur depuis l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_user = intval($_GET['id']);

// Récupérer les données de l'utilisateur
$query = "SELECT * FROM users WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Modifier l'utilisateur</title>
    <title>Administration - Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="../asset/css/modifier-utilisateur.css">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/menus.php'; ?>

    <main class="admin-content">
        <div class="container">
            <h1>Modifier l'utilisateur</h1>
            <!-- Zone pour afficher les messages -->
            <div id="message" style="color: green; margin-bottom: 1em;"></div>
            <form id="updateForm" action="traitement-modifier.php" method="POST">
                <!-- Champ caché pour l'ID de l'utilisateur -->
                <input type="hidden" name="id_user" value="<?= htmlspecialchars($user['id_user']) ?>">
                
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Adresse Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="role">Rôle</label>
                    <select id="role" name="role" required>
                        <option value="client" <?= $user['role'] === 'client' ? 'selected' : '' ?>>Client</option>
                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-submit">Mettre à jour l'utilisateur</button>
            </form>
            
            <hr>
            
            <h2>Supprimer cet utilisateur</h2>
            <p>Attention : cette action est irréversible.</p>
            <a href="supprimer.php?id=<?= htmlspecialchars($user['id_user']) ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                Supprimer l'utilisateur
            </a>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
    <script>
    // Gestion du formulaire en Ajax
    document.getElementById('updateForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        try {
            const response = await fetch('traitement-modifier.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            const messageDiv = document.getElementById('message');
            if(data.success) {
                messageDiv.style.color = "green";
                messageDiv.textContent = "Modification réussie ! Redirection en cours…";
                // Redirige vers la page index après 1,5 seconde pour afficher la liste à jour
                setTimeout(() => {
                    location.href = "index.php?success=updated";
                }, 1500);
            } else {
                messageDiv.style.color = "red";
                messageDiv.textContent = "Erreur : " + (data.error || "Une erreur est survenue.");
            }
        } catch (error) {
            console.error('Erreur Ajax:', error);
            document.getElementById('message').style.color = "red";
            document.getElementById('message').textContent = "Erreur de communication avec le serveur.";
        }
    });
    </script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>