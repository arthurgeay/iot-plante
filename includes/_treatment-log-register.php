<?php

if($page == 'connexion' && isset($_SESSION['email']) && isset($_SESSION['password_hash']) && isset($_SESSION['id'])) {
    header('Location: index.php?page=dashboard');
}


if(isset($_GET['action']) && $_GET['action'] == 'register' && isset($_POST['submit-register'])) {

    if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm-password'])) {
        $_SESSION['errors'][] = 'Vous devez renseignez tous les champs';
    }

    if($_POST['password'] != $_POST['confirm-password']) {
        $_SESSION['errors'][] = 'Les mots de passe ne correspondent pas';
    } else if (strlen($_POST['password']) > 30) {
        $_SESSION['errors'][] = 'Le mot de passe ne peut contenir plus de 30 caractères';
    }

    if(strlen($_POST['email']) > 100) {
        $_SESSION['errors'][] = "L'adresse e-mail ne peut contenir plus de 100 caractères";
    }

    $emailExist = emailExist($_POST['email']);


    if($emailExist) {
        $_SESSION['errors'][] = 'Cette addresse e-mail est déjà utilisée. Veuillez en utiliser une autre';
    }

    if(!isset($_SESSION['errors']) && !$emailExist) {

        addUser($_POST['email'], $_POST['password']);
        $_SESSION['success'] = "Inscription terminée ! Vous allez recevoir un e-mail de confirmation dans quelques minutes. Vous pouvez dès à présent vous connecter à notre application.<br /><a href='index.php'>Pour vous connecter, cliquez ici</a>";
        $message = 'Merci pour l\'inscription, vous pouvez désormais vous connecter au tableau de bord de Connected Flowers';

        mail($_POST['email'], 'Inscription Connected Flowers', $message);
    }
}


if(isset($_POST['submit-loggin'])) {
    if(empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['errors'][] = 'Vous devez renseignez tous les champs';
    }

    $emailExist = emailExist($_POST['email']);
    $passwordIsEquals = password_verify($_POST['password'], $emailExist['password_user']);

    if(!$emailExist || !$passwordIsEquals) {
        $_SESSION['errors'][] = 'Votre adresse e-mail ou votre mot de passe est incorrect';
    }

    if(!isset($_SESSION['errors']) && $emailExist && $passwordIsEquals) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password_hash'] = $emailExist['password_user'];
        $_SESSION['id'] = $emailExist['id_user'];

        header('Location: index.php?page=dashboard');
        exit();
    }
}
