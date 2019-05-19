<?php

if (!isset($_SESSION['email']) || !isset($_SESSION['password_hash']) || !isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}



if(isset($_POST['name']) && isset($_POST['date_start']) && isset($_POST['date_end']) && isset($_POST['temperature']) && isset($_POST['brightness']) && isset($_POST['humidity'])) {

    $pathFile = '';

    if(empty($_POST['name']) || empty($_POST['date_start']) || empty($_POST['date_end']) || empty($_POST['temperature']) || empty($_POST['brightness']) || empty($_POST['humidity'])) {
        $_SESSION['errors'][] = 'Veuillez remplir tous les champs obligatoire';
    }

    if(flowerExist($_POST['name'])) {
        $_SESSION['errors'][] = 'Cette plante existe déjà dans la base de données';
    } else {

        if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {

            $infosFile = pathinfo($_FILES['image']['name']);
            $extension = $infosFile['extension'];
            $extensionAuthorized = ['jpg', 'jpeg'];

            if(in_array($extension, $extensionAuthorized)) {
                if($_FILES['image']['size'] > 2000000) {
                    $_SESSION['errors'][] = 'Votre image est trop lourde, le système n\'acccèpte que les images de moins de 2 Mo';
                } else {
                    $pathFile = 'uploads/'.uniqid().'.'.$extension;
                    move_uploaded_file($_FILES['image']['tmp_name'], $pathFile);
                }
            } else {
                $_SESSION['errors'][] = 'Le seul format accepté pour les images est le jpg/jpeg';
            }
        }

        addFlower($_POST['name'], $_POST['humidity'], $_POST['temperature'], $_POST['brightness'], $_POST['date_start'], $_POST['date_end'], $_POST['category'], $_POST['description'], $pathFile);

        $_SESSION['success'] = 'La plante a bien été ajouté';
    }


}

