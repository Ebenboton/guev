<?php
// filepath: c:\wamp64\www\guev\administrateur\produits\traitement-modifier.php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupération et validation des champs
    $id = isset($_POST['id_produit']) ? intval($_POST['id_produit']) : 0;
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $prix = isset($_POST['prix']) ? floatval($_POST['prix']) : 0;
    $quantite = isset($_POST['quantiteEnStock']) ? intval($_POST['quantiteEnStock']) : 0;
    $categorie = isset($_POST['categorie']) ? trim($_POST['categorie']) : '';

    if ($id <= 0 || empty($nom) || $prix <= 0 || $quantite < 0) {
        $_SESSION['message'] = "Données invalides, veuillez réessayer.";
        header("Location: modifier.php?id=" . $id);
        exit();
    }

    // Traitement du fichier image (optionnel)
    $updateImage = false;
    $imageName = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Définir les extensions autorisées
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        $fileInfo = pathinfo($_FILES['image']['name']);
        $ext = strtolower($fileInfo['extension']);

        if (in_array($ext, $allowedExtensions)) {
            // Générer un nom unique pour l'image
            $imageName = uniqid("prod_", true) . "." . $ext;
            $targetDir = "../../assets/images/produits/";
            $targetFile = $targetDir . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $updateImage = true;
            } else {
                $_SESSION['message'] = "Erreur lors de l'upload de l'image.";
                header("Location: modifier.php?id=" . $id);
                exit();
            }
        } else {
            $_SESSION['message'] = "Type d'image non autorisé.";
            header("Location: modifier.php?id=" . $id);
            exit();
        }
    }

    // Préparer la requête UPDATE en fonction du fait qu'une image a été téléchargée ou non
    if ($updateImage) {
        $stmt = $conn->prepare("UPDATE produits SET nom = ?, prix = ?, quantiteEnStock = ?, categorie = ?, description = ?, image = ? WHERE id_produit = ?");
        if (!$stmt) {
            $_SESSION['message'] = "Erreur lors de la préparation de la requête : " . $conn->error;
            header("Location: modifier.php?id=" . $id);
            exit();
        }
        // "s" pour string, "d" pour decimal, "i" pour integer
        $stmt->bind_param("sdisssi", $nom, $prix, $quantite, $categorie, $description, $imageName, $id);
    } else {
        $stmt = $conn->prepare("UPDATE produits SET nom = ?, prix = ?, quantiteEnStock = ?, categorie = ?, description = ? WHERE id_produit = ?");
        if (!$stmt) {
            $_SESSION['message'] = "Erreur lors de la préparation de la requête : " . $conn->error;
            header("Location: modifier.php?id=" . $id);
            exit();
        }
        $stmt->bind_param("sdissi", $nom, $prix, $quantite, $categorie, $description, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Produit modifié avec succès.";
    } else {
        $_SESSION['message'] = "Une erreur est survenue lors de la modification : " . $stmt->error;
    }

    $stmt->close();
    header("Location: index.php");
    exit();
} else {
    $_SESSION['message'] = "Méthode non autorisée.";
    header("Location: index.php");
    exit();
}
?>