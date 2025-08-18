<?php
include __DIR__ . "/../../config/config.php";


    $req = $conn->prepare("INSERT INTO contacts (name,email,message) VALUES (?,?,?)");
    $req->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['message']);
    if($req->execute()){
        $_SESSION['success'] = 'Merci de nous contacter.';
    }else{
        $_SESSION['failure'] = 'Erreur merci de réessayer plus tard.';
    }
    $req->close();
    $conn->close();
    redirect("../../index.php");
