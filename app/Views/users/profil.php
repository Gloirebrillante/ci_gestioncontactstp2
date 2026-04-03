<?= $this->extend('templates/default') ?>

<?= $this->section('page_title') ?>Profil<?= $this->endSection() ?>
<?= $this->section('titre') ?>Mon profil<?= $this->endSection() ?>

<?= $this->section('contenu') ?>

<?= session()->getFlashdata('errors') ?>

<h2>Informations de l'utilisateur</h2>

<form>

    <label>Nom :</label>
    <input type="text" value="<?= esc($user['nom']) ?>" readonly><!-- En lecture seule pour éviter les modifications -->

    <br>
    <br>

    <label>Prénom :</label>
    <input type="text" value="<?= esc($user['prenom']) ?>" readonly>

    <br>
    <br>

    <label>Email :</label>
    <input type="email" value="<?= esc($user['email']) ?>" readonly>

    <br>
    <br>

    <p> Membre depuis le </p><?= esc($newDate = date("d/m/Y", strtotime($user['created_at']))) ?>

</form>

<?= $this->endSection() ?>