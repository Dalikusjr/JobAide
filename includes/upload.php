<?php
function Upfile($fileInput,$uploadDir = 'uploads/'){
    if (!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['error'] !== 0) {
        return ['success' => false, 'error' => 'Aucun fichier uploadé ou erreur.'];
    }

        $fileTmpPath = $_FILES[$fileInput]['tmp_name'];
        $fileName = $_FILES[$fileInput]['name'];
        $fileSize = $_FILES[$fileInput]['size'];
        $fileType = $_FILES[$fileInput]['type'];

        $allowedTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'image/jpeg'
        ];

        if (!in_array($fileType, $allowedTypes) || $fileSize > 3000000) {
            return ['success' => false, 'error' => 'Type de fichier ou taille invalide.'];
        }
            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $hashName = hash('sha256', $fileName . time()) . '.' . $extension;
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filePath = $uploadDir . $hashName;

            if (!move_uploaded_file($fileTmpPath, $filePath)) {
                return['success' =>false,'error'=> 'Erreur lors du déplacement du fichier.'];
            } 
            return ['success' => true,'filepath' => $filePath];
    }
