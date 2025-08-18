<?php
require __DIR__ . "/../../config/config.php";

// Si l'utilisateur est déjà connecté, rediriger vers le dashboard
if (isLoggedIn()) {
    redirect("../dashbord");
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $l_user = trim($_POST['l_user']);
    $l_pass = $_POST['l_pass'];

    // Validation basique
    if (empty($l_user) || empty($l_pass)) {
        $error = "Veuillez remplir tous les champs";
    } else {
        // Vérifier l'utilisateur dans la base de données
        $stmt = $conn->prepare("SELECT id, passwd,user_name,role FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $l_user);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Vérifier le mot de passe (utilisation de password_verify si hashé)
            if ($l_pass === $user['passwd']) { // Remplacez par password_verify() en production
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['user_name'];
                $_SESSION['role'] = $user['role'];
                redirect("../dashbord");
            } else {
                $error = "Mot de passe incorrect";
                $_SESSION['erreur']=$error;
                redirect("../../admin.php");
            }
        } else {
            $error = "Identifiants incorrects";
            $_SESSION['erreur']=$error;
             redirect("../../admin.php");
        }
    }
}
