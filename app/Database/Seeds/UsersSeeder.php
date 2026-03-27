<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('fr_FR'); // Génère des données en français
        
        $data = [];
        $domaines = ['gmail.com', 'yahoo.fr', 'outlook.com', 'laposte.net'];
        // Générer 5 utilisateurs aléatoires
        for ($i = 0; $i < 5; $i++) {
            $nom=strtoupper($this->enleverAccents($faker->lastName));
            $prenom=ucfirst($faker->firstName);
            $domaine = $domaines[array_rand($domaines)];
            $prenomSansAccents = strtolower($this->enleverAccents($prenom));
            $data[] = [
                'nom'       => $nom,
                'prenom'    => $prenom,
                'email'     => $prenomSansAccents.'.'.strtolower($nom).'@'.$domaine ,
                'password'  => password_hash($faker->password, PASSWORD_DEFAULT),
            ];
        }
        
        $this->db->table('users')->insertBatch($data);
   }
       private function enleverAccents(string $str): string
{
    $accents = [
        'à','â','ä','á','ã','å',
        'è','é','ê','ë',
        'î','ï','í','ì',
        'ô','ö','ó','ò','õ',
        'ù','û','ü','ú',
        'ý','ÿ',
        'ç','ñ',
        'À','Â','Ä','Á','Ã','Å',
        'È','É','Ê','Ë',
        'Î','Ï','Í','Ì',
        'Ô','Ö','Ó','Ò','Õ',
        'Ù','Û','Ü','Ú',
        'Ý',
        'Ç','Ñ',
    ];

    $remplacements = [
        'a','a','a','a','a','a',
        'e','e','e','e',
        'i','i','i','i',
        'o','o','o','o','o',
        'u','u','u','u',
        'y','y',
        'c','n',
        'A','A','A','A','A','A',
        'E','E','E','E',
        'I','I','I','I',
        'O','O','O','O','O',
        'U','U','U','U',
        'Y',
        'C','N',
    ];

    return str_replace($accents, $remplacements, $str);
}
}
