<?php

$result = getDataFlower();

if(!$result) {
    header('Location: index.php?page=plant');
}

if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    deleteMeasures();
    header('Location: index.php?page=plant');
}
