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
$site_title       = isset($_POST['site_title']) ? trim($_POST['site_title']) : '';
$site_email       = isset($_POST['site_email']) ? trim($_POST['site_email']) : '';
$site_description = isset($_POST['site_description']) ? trim($_POST['site_description']) : '';

// Vérifier que les champs obligatoires ne sont pas vides
if (empty($site_title) || empty($site_email) || empty($site_description)) {
    header("Location: parametre.php?message=Veuillez remplir tous les champs obligatoires");
    exit();
}

// Traitement du fichier logo s'il est téléchargé
$logo_filename = '';
if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../../assets/images/parametres/';
    $extension  = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
    $logo_filename = uniqid() . '.' . $extension;
    $upload_path = $upload_dir . $logo_filename;
    
    if (!move_uploaded_file($_FILES['logo']['tmp_name'], $upload_path)) {
        header("Location: parametre.php?message=Erreur lors du téléchargement du logo");
        exit();
    }
}

// Vérifier si un enregistrement de paramètres existe déjà (on travaille sur une seule ligne)
$query = "SELECT id FROM parametres LIMIT 1";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    // Mise à jour des paramètres existants
    if (!empty($logo_filename)) {
        $stmt = $conn->prepare("UPDATE parametres SET site_title = ?, site_email = ?, site_description = ?, logo = ? WHERE id = ?");
        // On suppose que l'enregistrement existant a l'ID = 1
        $id = 1;
        $stmt->bind_param("ssssi", $site_title, $site_email, $site_description, $logo_filename, $id);
    } else {
        $stmt = $conn->prepare("UPDATE parametres SET site_title = ?, site_email = ?, site_description = ? WHERE id = ?");
        $id = 1;
        $stmt->bind_param("sssi", $site_title, $site_email, $site_description, $id);
    }
    if ($stmt->execute()) {
        header("Location: parametre.php?message=Paramètres mis à jour");
        exit();
    } else {
        header("Location: parametre.php?message=Erreur lors de la mise à jour des paramètres");
        exit();
    }
} else {
    // Aucun enregistrement existant, insertion d'une nouvelle ligne
    if (!empty($logo_filename)) {
        $stmt = $conn->prepare("INSERT INTO parametres (site_title, site_email, site_description, logo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $site_title, $site_email, $site_description, $logo_filename);
    } else {
        $stmt = $conn->prepare("INSERT INTO parametres (site_title, site_email, site_description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $site_title, $site_email, $site_description);
    }
    if ($stmt->execute()) {
        header("Location: parametre.php?message=Paramètres enregistrés");
        exit();
    } else {
        header("Location: parametre.php?message=Erreur lors de l'enregistrement des paramètres");
        exit();
    }
}

$stmt->close();
$conn->close();
?>