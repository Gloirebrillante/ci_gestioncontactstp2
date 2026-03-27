<?= $this->extend('templates/default') ?>
<?= $this->section('page_title') ?>Inscription<?= $this->endSection() ?>
<?= $this->section('titre') ?>Inscription<?= $this->endSection() ?>
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
        <input type="email" name="email" value="<?= old('email') ?>">
        <br>
        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" value="<?= old('mdp') ?>">
        <br>
        <label for="mdpVerif">Confirmer le mot de passe</label>
        <input type="password" name="mdpVerif" value="<?= old('mdpVerif') ?>">
        <br>
        <input type="submit" name="submit" value="Créer un contact">
    </form>
</div>
<?= $this->endSection() ?>
