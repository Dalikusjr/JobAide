<?php
require __DIR__ . "../../config/config.php";
require __DIR__ . "../../includes/upload.php";
require '../strip-php/vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51RwK9hKqZZPtc3cYyG76Pqy5p2BnT3uVLkUlC7emRp99nvh91tNycCXKknNTthfeZvxbiSJu5f6h3KKMuQpPyGqD00uKo5MQ16');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['name'] = htmlspecialchars(trim($_POST['nom']));
    $_SESSION['mail'] = htmlspecialchars(trim($_POST['mail']));
    $_SESSION['tel'] = htmlspecialchars(trim($_POST['tel']));
    $_SESSION['poste'] = htmlspecialchars(trim($_POST['poste']));
    $_SESSION['local'] = htmlspecialchars(trim($_POST['local']));
    $_SESSION['description'] = htmlspecialchars(trim($_POST['description']));
    $_SESSION['mnt'] = intval($_POST['mnt']);
    $_SESSION['type_i'] = htmlspecialchars($_POST['type_i']);
    $_SESSION['cvTmp'] = Upfile('cv', $uploadDir = "../uploads/tmp/")['filepath'];

    $nom = $_SESSION['name'];
    $mnt = $_SESSION['mnt'];
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => ['name' => "Inscription de $nom"],
                'unit_amount' => $mnt * 100,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => "http://localhost/projet/inscription/process-inscrip.php?success=1",
        'cancel_url' => "http://localhost/projet/inscription/process-inscrip.php??success=0",
    ]);
    redirect($session->url);
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $_GET['success'];
    if (!$result) {
        session_unset();
        $_SESSION['failure'] = "Inscription échouée. Merci de réessayer.";
        $conn->close();
        redirect('http://localhost/projet/inscription/inscription.php');
    } else {
        $name = $_SESSION['name'];
        $mail = $_SESSION['mail'];
        $tel = $_SESSION['tel'];
        $poste = $_SESSION['poste'];
        $local = $_SESSION['local'];
        $descri = $_SESSION['description'];
        $mnt = $_SESSION['mnt'];
        $type_i = $_SESSION['type_i'];
        $cvTmp = $_SESSION['cvTmp'];
        $req = $conn->prepare("SELECT COUNT(*) FROM client WHERE email = ?");
        $req->bind_param("s", $_SESSION['mail']);
        $req->execute();
        $req->bind_result($count);
        $req->fetch();
        $req->close();

        if ($count == 0) {
            $req = $conn->prepare("INSERT INTO client (name, email, telnum, localisation) VALUES (?,?,?,?)");
            $req->bind_param("ssss",  $name, $mail, $tel, $local);
            if ($req->execute()) {
                $client_Id = $conn->insert_id;
            } else {
                $req->close();
                $conn->close();
                session_unset();
                $_SESSION['failure'] = "Erreur interne : impossible d’enregistrer votre inscription.";
                redirect('http://localhost/projet/inscription/inscription.php');
            }
            $req->close();
        } else {
            $req = $conn->prepare("SELECT id FROM client WHERE email = ?");
            $req->bind_param("s", $mail);
            $req->execute();
            $req->bind_result($client_Id);
            $req->fetch();
            $req->close();
        }

        $filePath = "../uploads/" . basename($cvTmp);
        rename($cvTmp, $filePath);

        $req = $conn->prepare("INSERT INTO inscription_ja (client_id, type_poste, cv, description,type_inscri) VALUES (?,?,?,?,?)");
        $req->bind_param("issss", $client_Id,  $poste, $filePath,  $descri, $type_i);
        if ($req->execute()) {
            $req->close();
            $conn->close();
            session_unset();
            $_SESSION['success'] = "Inscription réussie ! Vous recevrez bientôt un email de confirmation.";
            redirect('http://localhost/projet/inscription/inscription.php');
        } else {
            $req->close();
            $conn->close();
            session_unset();
            $_SESSION['failure'] = "Erreur interne : impossible d’enregistrer votre inscription. Merci de nous contacter.";
            redirect('http://localhost/projet/inscription/inscription.php');
        }
    }
}
