<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ContacterSeeder extends Seeder
{
    public function run()
    {
              
        $data = [
            [
                'user_id'    => 1,
                'contact_id' => 1,
                'notes'      => 'Très intéressé par nos solutions cloud',
                'statut'     => 'prospect',
            ],
            [
                'user_id'    => 1,
                'contact_id' => 2,
                'notes'      => 'Signature prévue pour fin de mois',
                'statut'     => 'client',
            ],
            [
                'user_id'    => 2,
                'contact_id' => 2,
                'notes'      => 'Contact partagé avec user_id n°1',
                'statut'     => 'client',
            ],
            [
                'user_id'    => 2,
                'contact_id' => 3,
                'notes'      => 'À relancer en février',
                'statut'     => 'prospect',
            ],
            [
                'user_id'    => 3,
                'contact_id' => 1,
                'notes'      => 'Manager - supervise tous les dossiers',
                'statut'     => 'prospect',
            ],
            [
                'user_id'    => 3,
                'contact_id' => 2,
                'notes'      => 'Manager - supervise tous les dossiers',
                'statut'     => 'client',
            ],
            [
                'user_id'    => 3,
                'contact_id' => 3,
                'notes'      => 'Manager - supervise tous les dossiers',
                'statut'     => 'prospect',
            ],
        ];

        $this->db->table('contacter')->insertBatch($data);
    }
}