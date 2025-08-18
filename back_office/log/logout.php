<?php
require __DIR__ . "/../../config/config.php";

// Détruire la session
session_unset();
session_destroy();
$conn->close();
// Rediriger vers la page de login
redirect("../../admin.php");
?>