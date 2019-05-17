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