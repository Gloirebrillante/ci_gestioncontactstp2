<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContacterTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'contact_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'statut' => [
                'type'       => 'ENUM',
                'constraint' => ['prospect', 'client', 'inactif'],
                'default'    => 'prospect',
            ],
        ]);
        
        // Clé primaire composite
        $this->forge->addKey(['user_id', 'contact_id'], true);
        
        // Clés étrangères
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('contact_id', 'contacts', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('contacter', true,  array(
            'ENGINE' => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci',
        )); // true = IF NOT EXISTS
    }

    public function down()
    {
        $this->forge->dropTable('contacter');
    }
}