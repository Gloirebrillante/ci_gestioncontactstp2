<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call('UsersSeeder');
        $this->call('ContactsSeeder');
        $this->call('ContacterSeeder');
        $this->call('ProduitsSeeder');
    }
    
}