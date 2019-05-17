<?php

$dateStart = new DateTime($result['date_start_flower']);
$dateEnd = new DateTime($result['date_end_flower']);

?>


<h2 class="mt-4 text-center">Tableau de bord</h2>

<div class="d-flex flex-column align-items-center">
    <div class="card mt-4 mb-3 text-center" style="max-width: 540px;">
        <img src="<?= $result['picture_flower']; ?>" class="card-img-top" alt="<?= $result['name_flower']; ?>" height="auto">
        <div class="card-body">
            <h5 class="card-title"><?= $result['name_flower']; ?></h5>
            <hr>
            <p><strong>Données récoltées</strong></p>
            <p class="card-text <?=  ($result['temperature_measures'] >= 10 && $result['temperature_measures'] <= $result['temperature_flower']) ? 'text-success' : 'text-danger' ?>"><strong>Température</strong> : <?= $result['temperature_measures']; ?> °C</p>
            <p class="card-text <?=  ($result['brightness_measures'] >= $result['brightness_flower']) ? 'text-success' : 'text-danger' ?>"><strong>Luminosité</strong> : <?= $result['brightness_measures']; ?> %</p>
            <p class="card-text <?=  ($result['humidity_measures'] >= $result['humidity_flower']) ? 'text-success' : 'text-danger' ?>"><strong>Humidité</strong> : <?= $result['humidity_measures']; ?> %</p>
            <hr>

            <p class="card-text">Description : <?= htmlentities(nl2br($result['description_flower'])); ?></p>
            <p class="card-text">Catégorie : <?= $result['category_flower']; ?></p>
            <p>Date de floraison : entre <?= $dateStart->format('M') .' et '. $dateEnd->format('M') ?></p>
            <p><a href="index.php?page=dashboard&action=delete" class="btn btn-danger">Supprimer la plante</a></p>
        </div>
    </div>
</div>
