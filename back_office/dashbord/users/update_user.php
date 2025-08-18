<?php
require __DIR__ . "/../../../config/config.php";



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = intval($_POST['user_id']);
    $role = $_POST['role'];
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];
    $user_n = $_POST['user_n'];
    $passwd = $_POST['passwd'];

    $req = $conn->prepare("UPDATE users SET
                                name = ?,
                                role = ?,
                                email = ?,
                                telnum = ?,
                                user_name = ?,
                                passwd = ?
                                WHERE id = ?;");
    $req->bind_param("ssssssi", $nom,$role, $mail, $tel, $user_n,$passwd, $client_id);
    if($req->execute()){
        $_SESSION["success"] = "Informations enregistrées.";
    }else{
        $_SESSION["failure"] = "Enregistrement échoué.";
    }
    $req->close();
    $conn->close();
    redirect("../?page=users");
}

