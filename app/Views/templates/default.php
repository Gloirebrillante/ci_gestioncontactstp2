<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title><?= $this->renderSection('page_title', true) ?></title>
</head>

<body>
    <div id="container" class='text-center'>
        <header>
            <h1>Découverte de CodeIgniter 4 - Gestion de contacts</h1>
        </header>
        <div id="page">
            <h2><?= $this->renderSection('titre', true) ?> </h2>

            <h2 class="success">
                <?= $this->renderSection('success', true) ?>
            </h2>



            <section>

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">CI4 tp2</a>
                    <ul class="navbar-nav mr-auto">



                        <?php if (session()->get('isLoggedIn')): ?>
                            <!-- Si l'utilisateur est connecté, on affiche en plus un bouton de déconnexion et de profil -->
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('users/profil') ?>">Profil</a></li>

                            <li class="nav-item"><a class="nav-link" href="<?= base_url('contacts') ?>">Contacts</a></li>

                            <li class="nav-item"><a class="nav-link" href="<?= base_url('contacts/create') ?>">Créer un
                                    contact</a></li>

                            <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/listeUser') ?>">Users</a></li>

                            <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/logout') ?>">Déconnexion</a>
                            </li>

                        <?php endif; ?>

                        <?php if (!session()->get('isLoggedIn')): ?>
                            <!-- Si l'utilisateur n'est pas connecté, on affiche en plus un bouton d'inscription et de connexion -->

                            <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/register') ?>">Inscription</a>
                            </li>

                            <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/login') ?>">Connexion</a></li>

                        <?php endif; ?>

                    </ul>
                </nav>

            </section>


            <div id="contenu">
                <?= $this->renderSection('contenu', true) ?>
            </div><!-- contenu -->
        </div><!-- page -->
        <footer><em>&copy; BTS SIO</em></footer>
    </div> <!-- container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>