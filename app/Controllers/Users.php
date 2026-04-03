<?php
namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{

    private $model;

    // Constructeur
    public function __construct()
    {
        $this->model = new UserModel();
    }



    // Fonction pour afficher le profil d'un user
    public function profil()
    {
        // Vérifier si connecté
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        // Récupérer l'utilisateur connecté via son id en session
        $userId = session()->get('user_id');

        // récupérer les infos de l'utilisateur
        $user = $this->model->find($userId);

        $data = [
            'user' => $user,
            'titre' => 'Mon profil'
        ];

        return view('users/profil', $data);
    }
    
}