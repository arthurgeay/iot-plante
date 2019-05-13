<?php $name = (!isset($_GET['action']) || $_GET['action'] != 'register') ? 'submit-loggin' : 'submit-register'; ?>

<h2 class="mt-4 text-center">Connexion</h2>

<?php if (isset($_SESSION['errors'])): ?>
    <div class="alert alert-danger">
        <?php foreach ($_SESSION['errors'] as $error): ?>
            <p><?= $error; ?></p>
        <?php endforeach;
        unset($_SESSION['errors']);
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <p><?= $_SESSION['success']; ?></p>
    </div>
<?php endif;
unset($_SESSION['success']);
?>

<form id="login" class="mt-4" method="post">
    <div class="form-group">
        <input type="email" class="form-control" placeholder="Adresse e-mail" name="email" required autofocus>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
    </div>
    <?php if(isset($_GET['action']) == 'register'): ?>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirmation du mot de passe" name="confirm-password" required>
        </div>
    <?php endif; ?>
    <input class="btn btn-block btn-primary" type="submit" value="Valider" name="<?= $name; ?>" />
    <a href="index.php?action=register">Vous n'avez pas de compte ?</a>
</form>