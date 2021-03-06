<?php
session_start();

require_once('includes/_db-functions.php');

$page = (!isset($_GET['page'])) ? 'connexion' : $_GET['page'];

switch($page) {
    case 'connexion':
        require_once('includes/_treatment-log-register.php');
        break;
    case 'logout':
        require_once('includes/_treatment-logout.php');
        break;
    case 'dashboard':
        require_once('includes/_treatment-dashboard.php');
        break;
    case 'plant':
        require_once('includes/_treatment-plant-flower.php');
        break;
    case 'add-plant':
        require_once('includes/_treatment-add-flower.php');
        break;

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
        <title>Connected Flowers</title>
    </head>
    <body>
    <?php require_once('includes/_nav.php'); ?>
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
                case 'plant':
                    require_once('includes/_plant-flower.php');
                    break;
                case 'add-plant':
                    require_once('includes/_add-flower.php');
                    break;
            }
        ?>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    </body>
</html>