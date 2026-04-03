<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProduitsSeeder extends Seeder
{

    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            $data = $this->getProduitData();
            $this->db->table('produits')->insert($data);
        }

    }

    private function getProduitData()
    {
        $faker = Factory::create();
        return [
            'nom' => $faker->words(2, true),
            'prix' => $faker->numberBetween(1, 999),
            'description' => $faker->sentence,
        ];
    }
}