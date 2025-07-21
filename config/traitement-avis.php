<?php

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification de la présence des champs et du consentement
    if (
        !isset($_POST['nom'], $_POST['email'], $_POST['produit'], $_POST['rating'], $_POST['commentaire'], $_POST['consent'])
        || empty(trim($_POST['nom']))
        || empty(trim($_POST['email']))
        || empty(trim($_POST['commentaire']))
    ) {
        header('Location: ../index.php?avis=missing');
        exit();
    }

    // Récupération et validation des données
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../index.php?avis=invalid_email');
        exit();
    }
    $produit_id = intval($_POST['produit']);
    $note = intval($_POST['rating']);
    $commentaire = trim($_POST['commentaire']);

    // Préparation de la requête pour insérer l'avis
    $stmt = $conn->prepare('INSERT INTO avis (nom, email, produit_id, note, commentaire, date_creation) VALUES (?, ?, ?, ?, ?, NOW())');
    if(!$stmt) {
        header('Location: ../index.php?avis=error');
        exit();
    }

    $stmt->bind_param('ssiis', $nom, $email, $produit_id, $note, $commentaire);

    if ($stmt->execute()) {
        header('Location: ../index.php?avis=success');
    } else {
        header('Location: ../index.php?avis=error');
    }
    $stmt->close();
    exit();
}

header('Location: ../index.php');
exit();
?>