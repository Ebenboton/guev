<?php
session_start();

// Vérifier que la requête est bien en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'id du produit et la quantité envoyée
    $productId = isset($_POST['id_produit']) ? $_POST['id_produit'] : null;
    $quantity = isset($_POST['quantite']) ? intval($_POST['quantite']) : 0;
    
    // Validation : id valide et quantité >= 1
    if (!$productId || $quantity < 1) {
        // En cas d'erreur, on enregistre le message dans la session et on redirige vers la page panier
        $_SESSION['update_cart_error'] = 'Produit invalide ou quantité non valide.';
        header("Location: ../panier.php");
        exit();
    }
    
    // Initialiser le panier s'il n'existe pas encore
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Mettre à jour la quantité du produit dans le panier
    $_SESSION['cart'][$productId] = $quantity;
    
    // En cas de succès, renvoyer la réponse JSON pour rediriger vers la page d'accueil
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Panier mis à jour.',
        'redirect' => 'index.php'
    ]);
    exit();
} else {
    // Si la méthode de requête n'est pas POST, on stocke un message d'erreur et on redirige vers la page panier
    $_SESSION['update_cart_error'] = 'Méthode de requête invalide.';
    header("Location: ../panier.php");
    exit();
}
?>