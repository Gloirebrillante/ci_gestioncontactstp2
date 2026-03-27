<?= $this->extend('templates/default') ?>
<?= $this->section('page_title') ?>Accueil<?= $this->endSection() ?>
<?= $this->section('titre') ?>Liste des contacts<?= $this->endSection() ?>
<?php if (isset($message)): ?>
    <?= $this->section('message') ?><?= $message ?><?= $this->endSection() ?>
<?php endif ?>
<?= $this->section('contenu') ?>
<?php if (!empty($contacts) && is_array($contacts)): ?>
    <table>
        <tr>
            <td>id</td>
            <td>nom</td>
            <td>prénom</td>
            <td>ville</td>
            <td>date de naissance</td>
            <td>email</td>
            <td>téléphone</td>
            <td>poste</td>
            <td></td>
        </tr>
        <?php foreach ($contacts as $contact): ?>
            <?php echo "<tr><td>" . esc($contact['id']) . "</td><td>" . esc($contact['nom']) . "</td><td>" . esc($contact['prenom']) . "</td><td>" . esc($contact['ville']) . "</td><td>". (isset($contact['naissance']) ? esc(date("d/m/Y", strtotime($contact['naissance']))) : 'Non renseigné') . "</td><td>" . esc($contact['email']) . "</td><td>" . esc($contact['telephone']) . "</td><td>" . esc($contact['poste']) . "</td><td>". anchor('contacts/delete/'.$contact['id'],'Supprimer') . "</td></tr>"; ?>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <h3>Aucun contact</h3>
<?php endif ?>
<?= $this->endSection() ?>
