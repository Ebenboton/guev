<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Configuration de la base de données TiDB Cloud
define('DB_HOST', 'gateway01.eu-central-1.prod.aws.tidbcloud.com'); // Ex: gateway01.eu-central-1.prod.aws.tidbcloud.com
define('DB_PORT', 4000);
define('DB_USER', '2hp4Ps5YC3kzPPn.root'); // Ex: xxxxxxxx.root
define('DB_PASS', 'XfA9GTUaab2JBb8q');
define('DB_NAME', 'guev_db');

// Initialisation de la connexion MySQLi
$conn = mysqli_init();

if (!$conn) {
    die("Échec de l'initialisation de MySQLi");
}

// Chemin vers le certificat SSL téléchargé
$ca_cert = __DIR__ . '/ca.pem';

// Configuration du certificat SSL pour TiDB Cloud
if (file_exists($ca_cert)) {
    $conn->ssl_set(NULL, NULL, $ca_cert, NULL, NULL);
}

// Options de connexion
$conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);

// Établissement de la connexion sécurisée
$connected = @$conn->real_connect(
    DB_HOST,
    DB_USER,
    DB_PASS,
    DB_NAME,
    DB_PORT,
    NULL,
    MYSQLI_CLIENT_SSL
);

// Vérification de la connexion
if (!$connected || $conn->connect_error) {
    die("Échec de la connexion à TiDB Cloud : " . ($conn->connect_error ?: mysqli_connect_error()));
}

// Définition de l'encodage
$conn->set_charset("utf8mb4");

// Initialisation du panier s'il n'existe pas
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>