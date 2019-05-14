<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Connected Flowers</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if(!isset($_SESSION['email']) && !isset($_SESSION['password_hash'])): ?>
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <?php else: ?>
                <li class="nav-item <?= (isset($_GET['page']) && $_GET['page'] == 'dashboard') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?page=dashboard">Tableau de bord</a>
                </li>
                <li class="nav-item <?= (isset($_GET['page']) && $_GET['page'] == 'plant') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?page=plant">Planter une plante</a>
                </li>
                <li class="nav-item <?= (isset($_GET['page']) && $_GET['page'] == 'add-plant') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?page=add-plant">Ajouter une plante au système</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Bonjour <?= $_SESSION['email']; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?page=logout">Déconnexion</a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>