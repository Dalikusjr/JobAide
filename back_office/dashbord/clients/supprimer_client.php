<?php
include __DIR__ . "/../../../config/config.php";


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $clientId = intval($_POST['id']);

    $req = $conn->prepare("SELECT COUNT(*) FROM inscription_ja WHERE client_id = ?");
    $req->bind_param("i", $clientId);
    $req->execute();
    $req->bind_result($count);
    $req->fetch();
    $req->close();

    if ($count > 0) {
        $_SESSION['failure'] = "Impossible de supprimer ce client : il possède encore " . $count . " inscription(s) liée(s).";
        redirect("../?page=clients");
    } else {
        $req = $conn->prepare("DELETE FROM client WHERE id = ?");
        $req->bind_param("i", $clientId);
        $req->execute();
        $req->close();
    }
    $_SESSION['success'] = "Le client a bien été supprimé";
    redirect("../?page=clients");
} else {
    $_SESSION['failure'] = "Requête invalide ou ID manquant.";
    redirect("../?page=clients");
}
