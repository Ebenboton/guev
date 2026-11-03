<?php
// Point d'entrée pour Vercel Serverless
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Si la racine est demandée, router vers index.php du projet
if ($requestUri === '/' || $requestUri === '') {
    require __DIR__ . '/../index.php';
    exit;
}

// Chemin absolu vers le fichier demandé
$file = realpath(__DIR__ . '/..' . $requestUri);

// Si le fichier existe et est un script PHP à l'intérieur du projet
if ($file && is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    // S'assurer qu'on ne sort pas de la racine du projet
    if (strpos($file, realpath(__DIR__ . '/..')) === 0) {
        require $file;
        exit;
    }
}

// Fichier non trouvé ou interdit
http_response_code(404);
echo "404 Not Found";