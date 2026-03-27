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
        <label for="naissance">Date de naissance</label>
        <input type="date" name="naissance" value="<?= old('naissance') ?>">
        <br>
        <label for="ville">Ville</label>
        <input type="input" name="ville" value="<?= old('ville') ?>">
        <br>   
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= old('email') ?>">
        <br>
        <label for="telephone">Téléphone</label>
        <input type="text" name="telephone" value="<?= old('telephone') ?>">
        <br>
        <label for="poste">Poste</label>
        <input type="text" name="poste" value="<?= old('poste') ?>">
        <br>
        <input type="submit" name="submit" value="Créer un contact">
    </form>
</div>
<?= $this->endSection() ?>
