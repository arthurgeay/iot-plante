<?php
session_start();

require_once('includes/db-functions.php');

$page = (!isset($_GET['page'])) ? 'connexion' : $_GET['page'];

if($page == 'connexion' && isset($_SESSION['email']) && isset($_SESSION['password_hash'])) {
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
        header('Location: index.php?page=dashboard');
    }
}

?>
<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css" />
        <title>Accueil - Connected Flowers</title>
    </head>
    <body>
    <div class="container">

        <h1 class="text-center text-success">Connected Flowers - La plante connectée</h1>

        <?php
            switch($page) {
                case 'connexion':
                    require_once('includes/_connexion.php');
                    break;
                case 'dashboard':
                    require_once('includes/_dashboard.php');
                    break;
            }
        ?>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>