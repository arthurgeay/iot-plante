<?php

unset($_SESSION['email']);
unset($_SESSION['password_hash']);
header('Location: index.php');
exit();