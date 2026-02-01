<?php
session_start();
require_once 'includes/db.php';

// Définir les chemins de base
$lienLogo = "./asset/";  
$adminBase = "./";
define('ASSETS_PATH', $adminBase . 'assets/');  // Définition de constante pour les assets

// Vérification de session admin plus robuste
if (empty($_SESSION['admin']['role'])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['admin']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Dashboard</title>
    <link rel="stylesheet" href="/guev/administrateur/asset/css/admin.css">
    <link rel="stylesheet" href="/guev/administrateur/asset/css/header1.css">
    <link rel="stylesheet" href="/guev/administrateur/asset/css/menu.css">
    <link rel="stylesheet" href="/guev/administrateur/asset/css/footer.css">
    <style>
        /* Style pour organiser les cartes sur deux lignes */
        .indexAdmin-cards {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .cards-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        
        .indexAdmin-card {
            flex: 1;
            min-width: 200px;
        }
    </style>
</head>
<body>
    <div class="main-line">
        <?php 
        // Inclusion des composants avec vérification
        @include 'includes/header.php'; 
        ?>
    </div>

    <div class="main-line">
        <main class="indexAdmin-main">
            <div class="indexAdmin-container">
                <h1>Bienvenue, <?= htmlspecialchars($_SESSION['admin']['pseudo'] ?? 'Admin') ?></h1>
                
                <div class="indexAdmin-cards">
                    <!-- Première ligne : Produits et Articles -->
                    <div class="cards-row">
                        <!-- Carte Produits -->
                        <div class="indexAdmin-card">
                            <h2>Nombre de produits</h2>
                            <?php
                            try {
                                $result = $conn->query("SELECT COUNT(*) AS total FROM produits");
                                $data = $result->fetch_assoc();
                                echo "<p>" . ($data['total'] ?? '0') . "</p>";
                            } catch (Exception $e) {
                                echo "<p class='indexAdmin-error'>N/A</p>";
                                error_log("Erreur produits: " . $e->getMessage());
                            }
                            ?>
                        </div>

                        <!-- Carte Articles -->
                        <div class="indexAdmin-card">
                            <h2>Nombre d'articles</h2>
                            <?php
                            try {
                                $result = $conn->query("SELECT COUNT(*) AS total FROM articles");
                                $data = $result->fetch_assoc();
                                echo "<p>" . ($data['total'] ?? '0') . "</p>";
                            } catch (Exception $e) {
                                echo "<p class='indexAdmin-error'>N/A</p>";
                                error_log("Erreur articles: " . $e->getMessage());
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Deuxième ligne : Commandes et Utilisateurs -->
                    <div class="cards-row">
                        <!-- Carte Commandes -->
                        <div class="indexAdmin-card">
                            <h2>Nombre de commandes</h2>
                            <?php
                            try {
                                $result = $conn->query("SELECT COUNT(*) AS total FROM commande");
                                $data = $result->fetch_assoc();
                                echo "<p>" . ($data['total'] ?? '0') . "</p>";
                            } catch (Exception $e) {
                                echo "<p class='indexAdmin-error'>N/A</p>";
                                error_log("Erreur commandes: " . $e->getMessage());
                            }
                            ?>
                        </div>

                        <!-- Carte Utilisateurs -->
                        <div class="indexAdmin-card">
                            <h2>Nombre d'utilisateurs</h2>
                            <?php 
                            try {
                                $result = $conn->query("SELECT COUNT(*) AS total FROM users");
                                $data = $result->fetch_assoc();
                                echo "<p>" . ($data['total'] ?? '0') . "</p>";
                            } catch (Exception $e) {
                                echo "<p class='indexAdmin-error'>N/A</p>";
                                error_log("Erreur utilisateurs: " . $e->getMessage());
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php @include 'includes/footer.php'; ?>
    </div>
    
    <!-- Script JS avec chemin absolu -->
    <script src="../assets/js/admin.js"></script>
</body>
</html>
<?php 
// Fermeture sécurisée de la connexion
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
?>