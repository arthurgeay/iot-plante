<?php

$dateStart = new DateTime($result['date_start_flower']);
$dateEnd = new DateTime($result['date_end_flower']);
$dateMeasures = new DateTime(($result['date_measures']));

?>


<h2 class="mt-4 text-center">Tableau de bord</h2>

<div class="d-flex flex-column align-items-center">
    <div class="card mt-4 mb-3 text-center" style="max-width: 540px;">
        <img src="<?= $result['picture_flower']; ?>" class="card-img-top" alt="<?= $result['name_flower']; ?>" height="auto">
        <div class="card-body">
            <h5 class="card-title"><?= $result['name_flower']; ?></h5>
            <hr>
            <p><strong>Données récoltées le <?= $dateMeasures->format('d/m/Y à H:i:s'); ?></strong></p>
            <p data-toggle="tooltip" data-placement="left" title="La température optimale est comprise entre 10°C et <?= $result['temperature_flower']; ?>°C" class="card-text <?=  ($result['temperature_measures'] >= 10 && $result['temperature_measures'] <= $result['temperature_flower']) ? 'text-success' : 'text-danger' ?>"><strong>Température</strong> : <?= $result['temperature_measures']; ?> °C</p>
            <p data-toggle="tooltip" data-placement="left" title="La luminosité optimale ne doit pas être en dessous de <?= $result['brightness_flower']; ?>%" class="card-text <?=  ($result['brightness_measures'] >= $result['brightness_flower']) ? 'text-success' : 'text-danger' ?>"><strong>Luminosité</strong> : <?= $result['brightness_measures']; ?> %</p>
            <p data-toggle="tooltip" data-placement="left" title="L'humidité optimale doit être de <?= $result['humidity_flower']; ?>%" class="card-text <?=  ($result['humidity_measures'] >= $result['humidity_flower']) ? 'text-success' : 'text-danger' ?>"><strong>Humidité</strong> : <?= $result['humidity_measures']; ?> %</p>
            <hr>

            <p class="card-text">Description : <strong><?= nl2br($result['description_flower']); ?></strong></p>
            <p class="card-text">Catégorie : <strong><?= $result['category_flower']; ?></strong></p>
            <p>Date de floraison : entre <strong><?= $dateStart->format('M') .' et '. $dateEnd->format('M') ?></strong></p>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">
                Supprimer la plante
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supprimer la plante et ses données de mesures</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer la plante et ses données ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <a href="index.php?page=dashboard&action=delete" class="btn btn-danger">Oui, je suis sûr</a>
            </div>
        </div>
    </div>
</div>
