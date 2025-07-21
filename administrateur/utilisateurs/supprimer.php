<?php
// filepath: c:\wamp64\www\guev\administrateur\utilisateurs\supprimer.php
session_start();
require_once '../includes/db.php';

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Vérifier et récupérer l'ID de l'utilisateur
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?error=ID utilisateur manquant");
    exit();
}

$id_user = intval($_GET['id']);

// Empêcher l'auto-suppression
if ($id_user === $_SESSION['admin']['id_user']) {
    header("Location: index.php?error=Vous ne pouvez pas supprimer votre propre compte");
    exit();
}

// Démarrer une transaction
$conn->begin_transaction();

try {
    // 1. Vérifier que l'utilisateur existe
    $check_query = "SELECT id_user FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    
    if ($stmt->get_result()->num_rows === 0) {
        header("Location: index.php?error=Utilisateur non trouvé");
        exit();
    }
    
    // 2. Supprimer les dépendances (ajuster selon votre schéma de base)
    // Exemple: $conn->query("DELETE FROM commandes WHERE user_id = $id_user");
    
    // 3. Supprimer l'utilisateur
    $delete_query = "DELETE FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    
    // Valider la transaction
    $conn->commit();
    
    header("Location: index.php?success=Utilisateur supprimé avec succès");
    
} catch (Exception $e) {
    // Annuler en cas d'erreur
    $conn->rollback();
    header("Location: index.php?error=Erreur lors de la suppression: " . urlencode($e->getMessage()));
} finally {
    if (isset($stmt)) $stmt->close();
    $conn->close();
}