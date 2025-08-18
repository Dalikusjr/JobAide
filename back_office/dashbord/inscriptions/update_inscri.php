<?php
include __DIR__ . "/../../../config/config.php";
include  __DIR__ . "/../../../includes/upload.php";



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inscri_id = intval($_POST['inscri_id']);
    $type_poste = $_POST['type_poste'];
    $description = $_POST['description'];
    $client_id = intval($_POST['client_id']);
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];
    $local = $_POST['local'];
    $cv = null;
    $upDir  = realpath(__DIR__ . '/../../../uploads/') . '/';
    if (!empty($_FILES['cv']['name'])) {
        $cv = Upfile('cv', $uploadDir = $upDir);
        $req = $conn->prepare("SELECT cv FROM inscription_ja WHERE id =?");
        $req->bind_param('i', $inscri_id);
        $req->execute();
        $row = $req->get_result()->fetch_assoc();
        $req->close();

        if (!$row['cv'] || !file_exists($row['cv'])) {
            unlink(realpath(__DIR__.'/../../../'.$row['cv']));
        }
    }
    if ($cv && $cv['success'] == true) {
        $req = $conn->prepare("UPDATE inscription_ja SET 
                                  type_poste = ?,
                                  cv = ?,
                                  description = ?
                                  WHERE id = ?;");
        $cv = 'uploads/' . basename($cv['filepath']);
        $req->bind_param("sssi", $type_poste, $cv, $description, $inscri_id);
    } else {
        $req = $conn->prepare("UPDATE inscription_ja SET 
                                  type_poste = ?,
                                  description = ?
                                  WHERE id = ?;");
        $req->bind_param("ssi", $type_poste, $description, $inscri_id);
    }
    $req->execute();
    $req->close();
    $req = $conn->prepare("UPDATE client SET
                                name = ?,
                                email = ?,
                                telnum = ?,
                                localisation = ?
                                WHERE id = ?;");
    $req->bind_param("ssssi", $nom, $mail, $tel, $local, $client_id);
    $req->execute();
    $req->close();
    $conn->close();
    redirect("../?page=inscriptions");
}
