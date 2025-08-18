<?php
include __DIR__ . "/../../../config/config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $req = $conn->prepare("INSERT INTO users (name,email,telnum,user_name,passwd,role) VALUES(?,?,?,?,?,?)");
    $req->bind_param("ssssss", $_POST['nom'], $_POST['email'], $_POST['tel'], $_POST['username'], $_POST['password'],$_POST['role']);
    if (!$req->execute()) {
        $_SESSION['failure'] = "Erreur exécution requête : " . $req->error;
        $req->close();
        $conn->close();
        redirect("../?page=users");
    }
    $req->close();
    $conn->close();
    $_SESSION['success'] = "Utilisateur ajouté avec succès.";
    redirect("../?page=users");
}
