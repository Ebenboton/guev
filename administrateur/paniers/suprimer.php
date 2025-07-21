<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Vérifier et récupérer l'ID du panier depuis l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_panier = intval($_GET['id']);

// Supprimer le panier de la base de données
$query = "DELETE FROM panier WHERE id_panier = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_panier);

if ($stmt->execute()) {
    header("Location: index.php?message=Panier supprimé");
} else {
    header("Location: index.php?message=Erreur lors de la suppression du panier");
}

$stmt->close();
$conn->close();
?>