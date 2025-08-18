<?php
include __DIR__ . "/../../../config/config.php";

$req = $conn->prepare("SELECT COUNT(*) AS total FROM users");
$req->execute();
$req->bind_result($total);
$req->fetch();
$req->close();
if ($total === 1) {
    $_SESSION['failure'] = "La suppression est impossible : il doit rester au moins un utilisateur.";
    redirect("../?page=users");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $userId = intval($_POST['id']);
    $req = $conn->prepare("DELETE FROM users WHERE id = ?");
    $req->bind_param("i", $userId);
    if (!$req->execute()) {
        $_SESSION['failure'] = "Erreur exécution requête : " . $req->error;
        $req->close();
        $conn->close();
        redirect("../?page=users");
    }
    $req->close();
    $req = $conn->prepare("SELECT COUNT(*) AS total FROM users");
    $req->execute();
    $req->bind_result($total);
    $req->fetch();
    $req->close();
    if ($total === 1) {
        $req = $conn->prepare("SELECT id FROM users LIMIT 1");
        $req->execute();
        $req->bind_result($lastUserId);
        $req->fetch();
        $req->close();
        $req = $conn->prepare("UPDATE users SET role = 'admin' WHERE id = ?");
        $req->bind_param("i", $lastUserId);
        $req->execute();
        $req->close();
    }
    $conn->close();
    $_SESSION['success'] = "L’utilisateur a été supprimé.";
    redirect("../?page=users");
}
