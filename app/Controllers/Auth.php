<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;


class Auth extends BaseController
{
     private $model;

    public function __construct()
    {
        $this->model = new UsersModel();
    }
    
    public function index()
    {
        //
    }
    
    public function register()
    {
        return view('auth/register');

    }

    public function login()
    {
        return view('auth/login');

    }

    public function store()
    {
       $data = $this->request->getPost(['nom', 'prenom', 'email', 'mdp', 'mdpVerif']);
    // vérification des règles de validation
    if (! $this->validateData($data, [
    'nom' => 'required|max_length[30]|min_length[3]|alpha_space',
    'prenom' => 'required|max_length[30]|min_length[2]|alpha_space',
    'email' => 'required|valid_email|is_unique[users.email]',
    'mdp' => 'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/]',
    'mdpVerif' => 'required|matches[mdp]'
    ])) {

    return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
    }

    // récupération des données validées et nettoyées et sauvegarde des données
    $postValid = $this->validator->getValidated();
    $res=$this->model->saveUser([
        'nom' => strtoupper($postValid['nom']),
        'prenom'=> ucfirst(strtolower($postValid['prenom']) ),
        'email' => $postValid['email'],
        'password' => password_hash($postValid['mdp'], PASSWORD_DEFAULT),
    ]); // strtoupper() et ucfirst pour respecter la casse en BD
    if ($res)
    {
    $data['titre'] = 'Inscription';
    $data['message'] = 'Utilisateur ajouté avec succès.';
    return view('auth/register', $data);           
    }
    else {
        return redirect()
                ->back()
                ->withInput()
                ->with('errors', ['db_error' => 'Erreur lors de l\'ajout en base de données']);
    }
}

public function loginAttempt()
    {
       $data = $this->request->getPost(['email', 'mdp']);
    if (! $this->validateData($data, [
    'email' => 'required|valid_email',
    'mdp' => 'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/]',
    ])) {
    return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
    }
    
    $postValid = $this->validator->getValidated();
    $user = $this->model->getUserByEmail($postValid['email']);
    if(!$user || !password_verify($postValid['mdp'], $user['password'])){
        return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
    }
    session()->regenerate();
    
    session()->set([
        'user_id'      => $user['id'],
        'logged_at'    => time(),
        ]);

    return redirect()->to(base_url('contacts'));
}

public function deconnexion(){
    session()->destroy();
    return redirect()->to(base_url('auth/login'));
}
}
