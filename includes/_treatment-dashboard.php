<?php


if (!isset($_SESSION['email']) || !isset($_SESSION['password_hash']) || !isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

$result = getDataFlower();

if (!$result) {
    header('Location: index.php?page=plant');
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    deleteMeasures();
    unlink('ressources/script-raspberry/data.txt');
    header('Location: index.php?page=plant');
    exit();
}



