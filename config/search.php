<?php
session_start();
require_once 'db.php';

// Vérifie que le paramètre de recherche "q" est présent et non vide
if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $term = trim($_GET['q']);
    // Redirige vers boutique.php en passant le terme de recherche en paramètre GET
    header("Location: ../boutique.php?q=" . urlencode($term));
    exit();
} else {
    // Redirige vers boutique.php sans paramètre si aucun terme n'est fourni
    header("Location: ../boutique.php");
    exit();
}
?>