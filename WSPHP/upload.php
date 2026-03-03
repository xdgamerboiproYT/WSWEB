<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['monFichier'];
    $uploadDir = '../uploads/';
    
    //  Validations
    $maxSize = 2 * 1024 * 1024; // 2 Mo
    $allowedType = 'application/pdf';

    if ($file['type'] !== $allowedType) {
        die("Erreur : Seuls les PDF sont acceptés.");
    }

    if ($file['size'] > $maxSize) {
        die("Erreur : Le fichier est trop lourd (max 2 Mo).");
    }

    //Sécurisation du nom
    $nomSecurise = htmlspecialchars(basename($file['name']));
    $cheminFinal = $uploadDir . basename($file['name']);

    //Déplacement
    if (move_uploaded_file($file['tmp_name'], $cheminFinal)) {
        echo "Succès ! Le fichier <strong>$nomSecurise</strong> a été enregistré.";
    }
}
?>