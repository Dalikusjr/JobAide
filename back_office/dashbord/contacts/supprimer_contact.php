<?php
include __DIR__ . "/../../../config/config.php";



if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $contactId = intval($_POST['id']); // forcer entier

    $req = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    if (!$req) {
        die("Erreur préparation requête : " . $conn->error);
    }

    $req->bind_param("i", $contactId);
    if (!$req->execute()) {
        $_SESSION['failure'] = "Erreur exécution requête : " . $req->error;
        $req->close();
        $conn->close();
        redirect("../?page=contacts");
    }

    $req->close();
    $conn->close();
    $_SESSION['success'] = "Le contact a bien été supprimé";
    redirect("../?page=contacts");
} else {
    $_SESSION['failure'] = "Requête invalide ou ID manquant.";
    redirect("../?page=contacts");
}
