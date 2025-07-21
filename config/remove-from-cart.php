<?php
session_start();

// Vérifier que l'ID du produit est présent dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../panier.php?message=Produit non spécifié");
    exit();
}

$product_id = intval($_GET['id']);

// Si le produit existe dans le panier, le supprimer
if (isset($_SESSION['cart'][$product_id])) {
    unset($_SESSION['cart'][$product_id]);
}

header("Location: ../panier.php?message=Produit supprimé");
exit();
?>