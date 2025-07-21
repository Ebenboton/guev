<?php
// filepath: c:\wamp64\www\guev\administrateur\commandes\supprimer.php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Vérifier que l'ID de la commande est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?message=Commande non spécifiée");
    exit();
}

$order_id = intval($_GET['id']);

// Supprimer d'abord les produits associés dans la table "panier"
$stmt = $conn->prepare("DELETE FROM panier WHERE id_commande = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$stmt->close();

// Supprimer la commande de la table "commande"
$stmt = $conn->prepare("DELETE FROM commande WHERE id_commande = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$stmt->close();

header("Location: index.php?message=Commande supprimée avec succès");
$conn->close();
exit();

?>