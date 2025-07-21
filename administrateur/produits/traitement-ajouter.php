<?php
session_start();
require_once '../includes/db.php';
$lienLogo = "..\\asset\\";

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Récupérer et nettoyer les données du formulaire
$nom              = isset($_POST['nom']) ? trim($_POST['nom']) : '';
$description      = isset($_POST['description']) ? trim($_POST['description']) : '';
$prix             = isset($_POST['prix']) ? floatval($_POST['prix']) : 0;
$quantiteEnStock  = isset($_POST['quantiteEnStock']) ? intval($_POST['quantiteEnStock']) : 0;
$categorie        = isset($_POST['categorie']) ? trim($_POST['categorie']) : '';

// Vérifier que les champs obligatoires ne sont pas vides
if (empty($nom) || empty($description) || $prix <= 0) {
    header("Location: ajouter.php?message=Veuillez remplir tous les champs obligatoires");
    exit();
}

// Traitement de l'image
$image_filename = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $upload_dir  = '../../assets/images/produits/';
    $extension   = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $image_filename = uniqid() . '.' . $extension;
    $upload_path = $upload_dir . $image_filename;
    
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
        header("Location: ajouter.php?message=Erreur lors du téléchargement de l'image");
        exit();
    }
}

// Préparer l'insertion dans la base de données
$stmt = $conn->prepare("INSERT INTO produits (nom, description, prix, quantiteEnStock, image, categorie) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    header("Location: ajouter.php?message=Erreur lors de la préparation de la requête");
    exit();
}

// Bind parameters : 
// 's' pour nom, 's' pour description, 'd' pour prix, 'i' pour quantiteEnStock, 's' pour image, 's' pour categorie
$stmt->bind_param("ssdiss", $nom, $description, $prix, $quantiteEnStock, $image_filename, $categorie);

if ($stmt->execute()) {
    header("Location: index.php?message=Produit ajouté avec succès");
    exit();
} else {
    header("Location: ajouter.php?message=Erreur lors de l'ajout du produit");
    $stmt->close();
    $conn->close();
    exit();
}

?>