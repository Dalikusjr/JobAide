<?php
include __DIR__ . "/../../../config/config.php";


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $inscriptionId = intval($_POST['id']);

    $req = $conn->prepare("SELECT cv FROM inscription_ja WHERE id = ?");
    $req->bind_param("i", $inscriptionId);
    if (!$req->execute()) {
        $_SESSION['failure'] = "Erreur exécution requête : " . $req->error;
        $req->close();
        $conn->close();
        redirect("../?page=inscriptions");
    }
    $req->bind_result($cvFile);
    $req->fetch();
    $req->close();

    if (!empty($cvFile)) {

        $filePath = realpath(__DIR__ . "/../../../" . $cvFile);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    $req = $conn->prepare("DELETE FROM inscription_ja WHERE id = ?");
    $req->bind_param("i", $inscriptionId);
    if (!$req->execute()) {
        $_SESSION['failure'] = "Erreur exécution requête : " . $req->error;
        $req->close();
        $conn->close();
        redirect("../?page=inscriptions");
    }

    $req->close();
    $conn->close();
    $_SESSION['success'] = "L'inscription a été supprimée avec succès.";
    redirect("../?page=inscriptions");
} else {
    $_SESSION['failure'] = "Erreur exécution requête : " . $req->error;
    redirect("../?page=inscriptions");
}
