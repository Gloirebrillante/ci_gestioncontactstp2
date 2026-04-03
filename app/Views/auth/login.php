<?= $this->extend('templates/default') ?>
<?= $this->section('page_title') ?>Accueil<?= $this->endSection() ?>
<?= $this->section('titre') ?>Accueil<?= $this->endSection() ?>

<?php if (isset($success)): ?>
    <?= $this->section('success') ?>     <?= $success ?>     <?= $this->endSection() ?>
<?php endif ?>

<?= $this->section('contenu') ?>

<?= session()->getFlashdata('error') ?>
<div>
    <?= validation_list_errors() ?>

    <form action="<?= base_url('auth/login') ?>" method="post">
        <?= csrf_field() ?>

        <label for="email">Email</label>
        <input type="input" name="email" value="<?= old('email') ?>">

        <br>

        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" value="<?= old('mdp') ?>">

        <br>

        <input type="submit" name="submit" value="Se connecter">
    </form>
</div>

<?= $this->endSection() ?>