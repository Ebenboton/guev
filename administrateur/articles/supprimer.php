<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Vérifier et récupérer l'ID de l'article depuis l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$article_id = intval($_GET['id']);

// Supprimer l'article de la base de données
$query = "DELETE FROM articles WHERE id_article = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $article_id);

if ($stmt->execute()) {
    header("Location: index.php?message=Article supprimé");
} else {
    header("Location: index.php?message=Erreur lors de la suppression de l'article");
}

$stmt->close();
$conn->close();
?>