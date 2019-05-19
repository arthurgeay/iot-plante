<h2 class="mt-4 text-center">Planter une plante</h2>

<p>Vous allez pouvoir choisir la plante que vous désirez planter ! </p>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; ?>
    </div>
<?php endif;
unset($_SESSION['success']);
?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; ?>
    </div>
<?php endif;
unset($_SESSION['error']);
?>


<form method="post">
    <div class="form-group">
        <select class="form-control" name="flower">
            <?php foreach($flowers as $flower): ?>
            <option value="<?= $flower['id_flower']; ?>"><?= $flower['name_flower']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <input class="btn btn-success" type="submit" name="plant-flower" />
</form>

<hr>

<h2 class="mt-4 text-center">Comment planter votre nouvelle plante ?</h2>

<h3>Matériels nécessaire</h3>

<ul>
    <li>Un crayon de papier</li>
    <li>Pot en terre cuite</li>
    <li>Terreau ou de la terre du jardin</li>
    <li>Gravier ou billes d'argiles</li>
    <li>Graines pour votre plante</li>
    <li>Arrosoir</li>
</ul>

<h3>Etapes pour planter votre plante</h3>

<ol>
    <li>Remplir votre pot de terreau</li>
    <ul>
        <li>Placez votre pot en terre cuite sous une soucoupe</li>
        <li>Versez au fond du pot du gravier ou des billes d'argiles (environ 3cm)</li>
        <li>Remplissez le pot de terreau ou de terre du jardin</li>
    </ul>
    <li>Plantez la graine</li>
    <ul>
        <li>Faites un trou de 3 à 4 cm avec le crayon de papier dans le terreau</li>
        <li>Déposez 3 graines dans le trou, afin de s'assurer qu'une des graines germe au minimum</li>
        <li>Rebouchez le trou à la main et tassez le terreau</li>
        <li>Arrosez l'ensemble du pot</li>
    </ul>
</ol>