<?= $this->extend('templates/default') ?>
<?= $this->section('page_title') ?>Connexion<?= $this->endSection() ?>
<?= $this->section('titre') ?>Connexion<?= $this->endSection() ?>
<?= $this->section('contenu') ?>
<?= session()->getFlashdata('error') ?>
<div>
    <?= validation_list_errors() ?>

     <form action="<?= base_url('auth/login') ?>" method="post">
        <?= csrf_field() ?>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= old('email') ?>">
        <br>
        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" value="<?= old('mdp') ?>">
        <br>
        <input type="submit" name="submit" value="Se connecter">
    </form>
</div>
<?= $this->endSection() ?>
