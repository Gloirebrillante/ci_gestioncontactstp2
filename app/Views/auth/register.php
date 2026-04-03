<?= $this->extend('templates/default') ?>
<?= $this->section('page_title') ?>Accueil<?= $this->endSection() ?>
<?= $this->section('titre') ?>Accueil<?= $this->endSection() ?>
<?= $this->section('contenu') ?>

<?= session()->getFlashdata('error') ?>
<div>
    <?= validation_list_errors() ?>

    <form action="<?= base_url('auth/register') ?>" method="post">
        <?= csrf_field() ?>

        <label for="nom">Nom</label>
        <input type="input" name="nom" value="<?= old('nom') ?>">

        <br>

        <label for="prenom">Prénom</label>
        <input type="input" name="prenom" value="<?= old('prenom') ?>">

        <br>

        <label for="email">Email</label>
        <input type="input" name="email" value="<?= old('email') ?>">

        <br>

        <label for="mdp1">Mot de passe</label>
        <input type="password" name="mdp1" value="<?= old('mdp1') ?>">

<br>

        <label for="mdp2">Mot de passe</label>
        <input type="password" name="mdp2" value="<?= old('mdp2') ?>">
        
        <br>

        <input type="submit" name="submit" value="Créer un user">
    </form>
</div>

<?= $this->endSection() ?>