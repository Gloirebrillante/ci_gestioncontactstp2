<?= $this->extend('templates/default') ?>
<?= $this->section('page_title') ?>Informations sur l'utilisateur<?= $this->endSection() ?>
<?= $this->section('titre') ?>Informations sur l'utilisateur<?= $this->endSection() ?>
<?= $this->section('contenu') ?>
<?= session()->getFlashdata('error') ?>
<div>
    <?= validation_list_errors() ?>
        <?= csrf_field() ?>
        <label for="nom">Nom</label>
        <input type="input" name="nom" value="<?= $user['nom'] ?>" readonly>
        <br>
        <label for="prenom">Prénom</label>
        <input type="input" name="prenom" value="<?= $user['prenom'] ?>" readonly>
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= $user['email'] ?>" readonly>
        <br>

        <p>Membre depuis le <?= $user['created_at'] ?></p>
</div>
<?= $this->endSection() ?>
