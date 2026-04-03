<?= $this->extend('templates/default') ?>
<?= $this->section('page_title') ?>Accueil<?= $this->endSection() ?>
<?= $this->section('titre') ?>Accueil<?= $this->endSection() ?>
<?= $this->section('contenu') ?>

<?= session()->getFlashdata('error') ?>
<div>
    <?= validation_list_errors() ?>

    <form action="<?= base_url('contacts') ?>" method="post">
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

        <label for="telephone">Téléphone</label>
        <input type="input" name="telephone" value="<?= old('telephone') ?>">

        <br>

        <label for="poste">Poste</label>
        <input type="input" name="poste" value="<?= old('poste') ?>">

        <br>

        <input type="submit" name="submit" value="Créer un contact">
    </form>
</div>

<?= $this->endSection() ?>