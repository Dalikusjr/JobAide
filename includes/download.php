<?php
// dossier des fichiers autorisés à télécharger
$uploadDir = realpath(__DIR__ . '/../uploads/');


// Récupérer le nom du fichier passé en GET
if (!isset($_GET['file'])) {
    die('Fichier non spécifié.');
}

$filename = basename($_GET['file']); // basename pour éviter les chemins relatifs

// Chemin complet vers le fichier
$filePath = $uploadDir . '/' . $filename;
// Vérifier que le fichier existe ET qu’il est bien dans le dossier uploads (sécurité)
if (!file_exists($filePath) || strpos(realpath($filePath), realpath($uploadDir)) !== 0) {
    die('Fichier non trouvé ou accès interdit.');
}

// Envoi des headers pour forcer le téléchargement
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));

ob_clean();
flush();

// Lire et envoyer le fichier
readfile($filePath);
exit;
