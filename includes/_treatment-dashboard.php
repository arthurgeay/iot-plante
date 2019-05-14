<?php

$result = getDataFlower();

if(!$result) {
    header('Location: index.php?page=plant');
}
