<h2 class="mt-4 text-center">Ajouter une plante</h2>

<p>La plante que vous voulez, n'existe pas dans notre base de données ? Vous pouvez l'ajouter dès maintenant ! </p>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; ?>
    </div>
<?php endif;
unset($_SESSION['success']);
?>

<?php if (isset($_SESSION['errors'])): ?>
    <div class="alert alert-danger">
        <?php foreach($_SESSION['errors'] as $error): ?>
            <p><?= $error; ?></p>
         <?php endforeach; ?>
    </div>
<?php endif;
unset($_SESSION['errors']);
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Nom de la plante (obligatoire)</label>
        <input type="text" class="form-control" id="name" name="name" autofocus required>
    </div>

    <div class="form-group">
       <input type="file" name="image"/>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="date-start">Date de début de floraison (obligatoire)</label>
                <input type="date" class="form-control" id="date-start" name="date_start" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="date-end">Date de fin de floraison (obligatoire)</label>
                <input type="date" class="form-control" id="date-end" name="date_end" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="temp">Température optimale (obligatoire)</label>
                <input type="number" min="0" step="any" class="form-control" id="temp" name="temperature" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="lum">Luminosité optimale (obligatoire)</label>
                <input type="number" min="0"  class="form-control" id="lum" name="brightness" required>
            </div>
        </div>
    </div>


    <div class="form-group">
        <label for="hum">Humidité optimale (obligatoire)</label>
        <input type="number" min="0" step="any" class="form-control" id="hum" name="humidity" required>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" id="desc" name="description"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="category">Catégorie de la plante</label>
                <input type="text" class="form-control" id="category" name="category" />
            </div>
        </div>
    </div>


    <input class="btn btn-success" type="submit" />
</form>
