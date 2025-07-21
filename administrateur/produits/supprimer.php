<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Vérifier et récupérer l'ID du produit depuis l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_produit = intval($_GET['id']);

// Désactiver temporairement les vérifications de clés étrangères
$conn->query("SET FOREIGN_KEY_CHECKS=0");

// Commencer une transaction
$conn->begin_transaction();

try {
    // 1. Supprimer d'abord les avis associés
    $query = "DELETE FROM avis WHERE produit_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produit);
    $stmt->execute();
    $stmt->close();

    // 2. Ensuite supprimer le produit
    $query = "DELETE FROM produits WHERE id_produit = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produit);
    $stmt->execute();
    $stmt->close();

    // Valider la transaction
    $conn->commit();
    
    header("Location: index.php?message=Produit et avis associés supprimés avec succès");
} catch (Exception $e) {
    // En cas d'erreur, annuler la transaction
    $conn->rollback();
    header("Location: index.php?message=Erreur lors de la suppression: " . urlencode($e->getMessage()));
}

// Réactiver les vérifications de clés étrangères
$conn->query("SET FOREIGN_KEY_CHECKS=1");
$conn->close();
?>