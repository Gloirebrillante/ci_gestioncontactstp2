<?php
namespace App\Controllers;
use App\Models\ContactModel;
use CodeIgniter\Controller;

use App\Models\UserModel; // Importer le modèle UserModel pour pouvoir l'utiliser dans le controleur Auth

class Auth extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }



    // Fonction pour afficher la page d'accueil avec la liste des users
    public function index()
    {
        $data = [
            'users' => $this->model->getUser(),
            'titre' => 'Liste des users',
        ];
        return view('auth/listeUser', $data); // $data 2ème paramètre = données transmises à la vue
    }



    // Fonction pour traiter les données du formulaire d'inscription et les insérer en BDD
    public function store()
    {
        $data = $this->request->getPost(['nom', 'prenom', 'email', 'mdp1', 'mdp2']);
        // vérification des règles de validation
        if (
            !$this->validateData($data, [
                'nom' => 'required|max_length[30]|min_length[3]|alpha_space',
                'prenom' => 'required|max_length[30]|min_length[2]|alpha_space',
                'email' => 'required|valid_email',
                'mdp1' => 'required|min_length[8]',
                'mdp2' => 'required|matches[mdp1]',
            ])
        ) {
            // si la validation échoue
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // récupération des données validées et nettoyées et sauvegarde des données
        $postValid = $this->validator->getValidated();
        $res = $this->model->saveUser([
            'nom' => strtoupper($postValid['nom']),
            'prenom' => ucfirst(strtolower($postValid['prenom'])),
            'email' => strtolower($postValid['email']),
            'password' => password_hash($postValid['mdp1'], PASSWORD_DEFAULT), // Hash du mot de passe pour plus de sécurité
        ]); // strtoupper() et ucfirst pour respecter la casse en BD

        if ($res) {
            $data['user'] = $this->model->getUser();
            $data['titre'] = 'Liste des users';
            $data['success'] = 'User ajouté avec succès !';
            return view('auth/login', $data);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', ['db_error' => 'Erreur lors de l\'ajout en base de données']);
        }
    }



    // Fonction pour afficher la page d'inscription
    public function register()
    {
        return view('auth/register');
    }



    // Fonction pour afficher la page de connexion après l'inscription d'un user
    public function login()
    {
        return view('auth/login');
    }



    // Fonction pour supprimer un user de la liste des users
    public function delete($num)
    {
        $this->model->delete($num);
        $data['users'] = $this->model->getUser();
        return view('auth/listeUser', $data);
    }



    // Fonction pour traiter les données du formulaire de connexion et connecter le user
    public function loginAttempt()
    {
        $data = $this->request->getPost(['email', 'mdp']);

        if (
            !$this->validateData($data, [
                'email' => 'required|valid_email',
                'mdp' => 'required|min_length[8]',
            ])
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $postValid = $this->validator->getValidated();

        $user = $this->model->getUserByEmail(strtolower($postValid['email']));

        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', ['login' => 'Email ou mot de passe incorrect.']);
        }

        if (!password_verify($postValid['mdp'], $user['password'])) {  // Verification du mot de passe
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', ['login' => 'Email ou mot de passe incorrect.']);
        }

        session()->set([
        'user_id'      => $user['id'],
        'logged_at'    => time(),
        'isLoggedIn' => true,
        ]);


        return redirect()->to('/contacts');
        session->regenerate();
    }



    // Fonction pour déconnecter un user
    public function logout()
    {
        session()->destroy(); // supprime toute la session

        return redirect()->to('/auth/login');
    }

}