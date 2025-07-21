<?php
// filepath: c:\wamp64\www\guev\administrateur\discussion.php
session_start();

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'includes/db.php';
$lienLogo = "..\\asset\\";

// Récupérer les messages soumis via le formulaire de contact
// On suppose que les messages sont enregistrés dans une table "contact" comportant (id, nom, email, sujet, message, date_envoi)
$query = "SELECT * FROM contact ORDER BY date_envoi DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages du Formulaire de Contact - Administration</title>
    <link rel="stylesheet" href="./asset/css/discussion.css">
    <link rel="stylesheet" href="./asset/css/header1.css">
    <link rel="stylesheet" href="./asset/css/menu1.css">
    <link rel="stylesheet" href="./asset/css/footer.css">
</head>
<body>
    <?php include './includes/header.php'; ?>
    <?php //include '../includes/menu1.php'; ?>

    <main class="admin-content">
        <div class="container">
            <h1>Messages du Formulaire de Contact</h1>
            <?php if ($result && $result->num_rows > 0): ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Sujet</th>
                            <th>Message</th>
                            <th>Date d'envoi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($message = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($message['id']) ?></td>
                            <td><?= htmlspecialchars($message['nom']) ?></td>
                            <td><?= htmlspecialchars($message['email']) ?></td>
                            <td><?= htmlspecialchars($message['sujet']) ?></td>
                            <td><?= nl2br(htmlspecialchars($message['message'])) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($message['date_envoi'])) ?></td>
                            <td>
                                <a href="reply.php?id=<?= $message['id'] ?>" class="btn-reply">Répondre</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun message n'a été soumis pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
    <?php $conn->close(); ?>
</body>
</html>