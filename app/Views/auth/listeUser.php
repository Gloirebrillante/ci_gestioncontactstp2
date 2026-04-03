<?= $this->extend('templates/default') ?>
<?= $this->section('page_title') ?>Accueil<?= $this->endSection() ?>
<?= $this->section('titre') ?>Accueil<?= $this->endSection() ?>

<?php if (isset($success)): ?>
    <?= $this->section('success') ?>     <?= $success ?>     <?= $this->endSection() ?>
<?php endif ?>

<?= $this->section('contenu') ?>

<?php if (!empty($users) && is_array($users)): ?>
    <table>
        <tr>
            <td>id</td> <!-- Liste des users -->
            <td>nom</td>
            <td>prénom</td>
            <td>email</td>
        </tr>
        <?php foreach ($users as $user): ?>
            <?php echo "<tr><td>" . esc($user['id']) . "</td><td>" . esc($user['nom']) . "</td><td>" . esc($user['prenom']) . "</td><td>" .
                esc($user['email']) . "</td><td>" . "</td><td>" . anchor('auth/delete/' . $user['id'], 'Supprimer') . "</td></tr>"; ?>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <h3>Aucun contact</h3>
<?php endif ?>
<?= $this->endSection() ?>