<?php
namespace App\Models;
use CodeIgniter\Model;



class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['nom', 'prenom', 'email', 'password'];


    // Fonction pour récupérer tous les utilisateurs de la table users
    public function getUser()
    {
        return $this->findAll();
    }



    // Fonction pour sauvegarder un nouvel utilisateur en BDD
    public function saveUser(array $user): bool
    {
        return $this->save($user);
    }



    // Fonction pour récupérer un utilisateur à partir de son email
    public function getUserByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

}
?>