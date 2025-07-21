<?php
require_once '../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    
    // Vérifier si le produit existe
    $productQuery = $conn->query("SELECT id_produit FROM produits WHERE id_produit = $productId");
    if ($productQuery->num_rows > 0) {
        // Ajouter au panier (session)
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 1;
        } else {
            $_SESSION['cart'][$productId]++;
        }
        
        // Ajouter aussi dans la table cart si l'utilisateur est connecté
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $existingCartItem = $conn->query("SELECT id FROM cart WHERE id_user = $userId AND id_produit = $productId");
            
            if ($existingCartItem->num_rows > 0) {
                $conn->query("UPDATE cart SET quantite = quantite + 1 WHERE id_user = $userId AND id_produit = $productId");
            } else {
                $conn->query("INSERT INTO cart (id_user, id_produit, quantite) VALUES ($userId, $productId, 1)");
            }
        }
        
        echo json_encode([
            'success' => true,
            'cartCount' => array_sum($_SESSION['cart'])
        ]);
        exit();
    }
}

echo json_encode(['success' => false]);