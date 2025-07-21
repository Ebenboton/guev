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
$title       = isset($_POST['title']) ? trim($_POST['title']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';

// Vérifier que les champs obligatoires ne sont pas vides
if (empty($title) || empty($description)) {
    header("Location: ajouter.php?message=Veuillez remplir tous les champs obligatoires");
    exit();
}

// Initialiser le nom de fichier média à une chaîne vide (plutôt que null)
$media_filename = '';

// Vérifier et traiter le fichier média si présent
if (isset($_FILES['media']) && $_FILES['media']['error'] !== UPLOAD_ERR_NO_FILE) {

    // Vérifier s'il n'y a pas d'erreur lors du téléchargement
    if ($_FILES['media']['error'] === UPLOAD_ERR_OK) {
        $upload_dir  = '../../assets/images/articles/';
        // S'assurer que le dossier de destination se termine par un slash
        if (substr($upload_dir, -1) !== '/') {
            $upload_dir .= '/';
        }
        $extension = strtolower(pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION));
        // Autoriser certaines extensions (optionnel)
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif', 'mp4', 'webm', 'ogg');
        if (!in_array($extension, $allowed_ext)) {
            header("Location: ajouter.php?message=Extension de fichier non autorisée");
            exit();
        }
        $media_filename = uniqid() . '.' . $extension;
        $upload_path = $upload_dir . $media_filename;

        // Vérifier la validité du fichier uploadé
        if (!is_uploaded_file($_FILES['media']['tmp_name'])) {
            header("Location: ajouter.php?message=Fichier non valide");
            exit();
        }

        // Tenter de déplacer le fichier téléchargé
        if (!move_uploaded_file($_FILES['media']['tmp_name'], $upload_path)) {
            header("Location: ajouter.php?message=Erreur%20lors%20du%20téléchargement%20du%20fichier%20média");
            exit();
        }
    } else {
        // Gestion d'autres erreurs de téléchargement
        header("Location: ajouter.php?message=Erreur%20de%20téléchargement%20(Erreur " . $_FILES['media']['error'] . ")");
        exit();
    }
}

// Préparer et exécuter l'insertion dans la base de données
$stmt = $conn->prepare("INSERT INTO articles (title, description, media) VALUES (?, ?, ?)");
if (!$stmt) {
    header("Location: ajouter.php?message=Erreur%20lors%20de%20la%20préparation%20de%20la%20requête");
    exit();
}

$stmt->bind_param("sss", $title, $description, $media_filename);

if ($stmt->execute()) {
    header("Location: index.php?message=Article ajouté avec succès");
    exit();
} else {
    header("Location: ajouter.php?message=Erreur%20lors%20de%20l'ajout%20de%20l'article");
    exit();
}

$stmt->close();
$conn->close();
?>