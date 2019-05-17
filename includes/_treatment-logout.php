<?php

unset($_SESSION['email']);
unset($_SESSION['password_hash']);
unset($_SESSION['id']);
header('Location: index.php');
exit();