<?php

if (!isset($_SESSION['email']) || !isset($_SESSION['password_hash']) || !isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

$flowers = getFlowers();

if(isset($_POST['flower']) && !empty($_POST['flower'])) {
    if(flowerExist($_POST['flower'])) {
        $file = fopen('ressources/script-raspberry/data.txt', 'w');
        fwrite($file, $_SESSION['id'].';'.$_POST['flower'].';'.$_SESSION['email']);
        fclose($file);
        $_SESSION['success'] = 'La plante a bien été ajouté. Vous pouvez dès à présent accéder à votre tableau de bord';
    } else {
        $_SESSION['error'] = 'Cette plante n\'existe pas';
    }
}
