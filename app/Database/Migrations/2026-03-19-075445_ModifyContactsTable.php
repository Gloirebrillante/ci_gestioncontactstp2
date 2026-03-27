<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyContactsTable extends Migration
{
    public function up()
    {
         
        // Ajouter de nouveaux champs
        $fields = [
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'after'      => 'prenom',
            ],
            'telephone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'email',
            ],

            'poste' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'telephone',
            ],
         'created_at' => [
        'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            ],
        ];
        $this->forge->addKey('email', false, true); // PRIMARY KEY =false, UNIQUE KEY =true
        $this->forge->addColumn('contacts', $fields);
    }

    public function down()
    {
        // Annuler les modifications
        $this->forge->dropColumn('contacts', ['email', 'telephone', 'poste', 'created_at']);
    }
}