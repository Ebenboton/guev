<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Récupérer les paramètres du site depuis la table "parametres"
$query = "SELECT * FROM parametres LIMIT 1";
$result = $conn->query($query);
if ($result && $result->num_rows > 0) {
    $param = $result->fetch_assoc();
} else {
    // Valeurs par défaut si aucun enregistrement n'existe
    $param = [
        'site_title'       => '',
        'site_email'       => '',
        'site_description' => '',
        'logo'             => ''
    ];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Paramètres du Site</title>
    <link rel="stylesheet" href="../assets/css/modifier-parametre.css">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/menus.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/menus.php'; ?>

    <main class="admin-content">
        <div class="container">
            <h1>Paramètres du Site</h1>
            <?php if (isset($_GET['message'])): ?>
                <p class="message"><?= htmlspecialchars($_GET['message']) ?></p>
            <?php endif; ?>
            <form action="traitement-parametre.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="site_title">Titre du site</label>
                    <input type="text" id="site_title" name="site_title" value="<?= htmlspecialchars($param['site_title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="site_email">Email de contact</label>
                    <input type="email" id="site_email" name="site_email" value="<?= htmlspecialchars($param['site_email']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="site_description">Description du site</label>
                    <textarea id="site_description" name="site_description" rows="5" required><?= htmlspecialchars($param['site_description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="logo">Logo du site (laisser vide pour ne pas modifier)</label>
                    <input type="file" id="logo" name="logo" accept="image/*">
                    <?php if (!empty($param['logo'])): ?>
                        <div class="current-logo">
                            <p>Logo actuel:</p>
                            <img src="../../assets/images/parametres/<?= htmlspecialchars($param['logo']) ?>" alt="Logo du site" style="max-width:150px;">
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn-submit">Mettre à jour les paramètres</button>
            </form>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>