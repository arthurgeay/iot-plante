<?php

if (!isset($_SESSION['email']) && !isset($_SESSION['password_hash'])) {
    header('Location: index.php');
    exit();
}


