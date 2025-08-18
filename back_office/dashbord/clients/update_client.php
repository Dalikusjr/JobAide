<?php
require __DIR__ . "/../../../config/config.php";



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = intval($_POST['client_id']);
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];
    $local = $_POST['local'];
    $req = $conn->prepare("UPDATE client SET
                                name = ?,
                                email = ?,
                                telnum = ?,
                                localisation = ?
                                WHERE id = ?;");
    $req->bind_param("ssssi", $nom, $mail, $tel, $local, $client_id);
    if($req->execute()){
        $_SESSION["success"] = "Informations enregistrées.";
    }else{
        $_SESSION["failure"] = "Enregistrement échoué.";
    }
    $req->close();
    $conn->close();
    redirect("../?page=clients");
}

