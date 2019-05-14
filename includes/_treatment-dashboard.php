<?php


if (!isset($_SESSION['email']) && !isset($_SESSION['password_hash'])) {
    header('Location: index.php');
    exit();
}

$result = getDataFlower();

if (!$result) {
    header('Location: index.php?page=plant');
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    deleteMeasures();
    header('Location: index.php?page=plant');
}



