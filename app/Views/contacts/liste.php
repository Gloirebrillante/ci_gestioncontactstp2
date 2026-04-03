<?= $this->extend('templates/default') ?>
<?= $this->section('page_title') ?>Accueil<?= $this->endSection() ?>
<?= $this->section('titre') ?>Accueil<?= $this->endSection() ?>

<?php if (isset($success)): ?>
    <?= $this->section('success') ?>    <?= $success ?>    <?= $this->endSection() ?>
<?php endif ?>

<?= $this->section('contenu') ?>

<?php if (!empty($contacts) && is_array($contacts)): ?>
    <table>
        <tr>
            <td>id</td> <!-- Liste des contacts -->
            <td>nom</td>
            <td>prénom</td>
            <td>ville</td>
            <td>Date</td>
            <td>Email</td>
            <td>Téléphone</td>
            <td>Poste</td>
        </tr>
        <?php foreach ($contacts as $contact): ?>
            <?php echo "<tr><td>" . esc($contact['id']) . "</td><td>" . esc($contact['nom']) . "</td><td>" . esc($contact['prenom']) . "</td><td>" .
                esc($contact['ville']) . "</td><td>" . (isset($contact['naissance']) ? esc($newDate = date("d/m/Y", strtotime($contact['naissance']))) : 'Non renseignée') .
                "</td><td>" . esc($contact['email']) . "</td><td>" . esc($contact['telephone']) . "</td><td>" . esc($contact['poste']) . "</td><td>" .
                anchor('contacts/delete/' . $contact['id'], 'Supprimer') . "</td></tr>"; ?>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <h3>Aucun contact</h3>
<?php endif ?>
<?= $this->endSection() ?>