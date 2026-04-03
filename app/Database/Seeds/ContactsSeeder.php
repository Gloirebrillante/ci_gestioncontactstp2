<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ContactsSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('fr_FR'); // Génère des données en français

        $data = [];

        // Générer 20 contacts aléatoires
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'nom' => strtoupper($faker->lastName),
                'prenom' => ucfirst($faker->firstName),
                'naissance' => $faker->date('Y-m-d', '-18 years'), // Entre 18 et 80 ans
                'ville' => strtoupper($faker->city),
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'poste' => $faker->jobTitle,

            ];
        }

        $this->db->table('contacts')->insertBatch($data);
    }
}