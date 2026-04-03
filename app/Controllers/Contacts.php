<?php
namespace App\Controllers;
use App\Models\ContactModel;
use App\Models\ContacterModel;
use CodeIgniter\Controller;
class Contacts extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new ContactModel();
    }



    // Fonction pour afficher la page d'accueil avec la liste des contacts
    public function index()
    {
        $data = [
            'contacts' => $this->model->getContactsOfUser(session()->get('user_id')),
            'titre' => 'Liste des contacts',
        ];
        return view('contacts/liste', $data); // $data 2ème paramètre = données transmises à la vue
    }



    // Fonction pour afficher le formulaire de création d’un contact
    public function create()
    {
        // helper('form'); // A NE PAS OUBLIER pour récupérer les messages d’erreurs
        return view('contacts/form'); // affiche le formulaire de création d’un contact
    }



    public function store()
    {
        $data = $this->request->getPost(['nom', 'prenom', 'email', 'telephone', 'poste']);
        // vérification des règles de validation
        if (
            !$this->validateData($data, [
                'nom' => 'required|max_length[30]|min_length[3]|alpha_space',
                'prenom' => 'required|max_length[30]|min_length[2]|alpha_space',
                'email' => 'required|valid_email',
                'telephone' => 'required|regex_match[/^[0-9]{10}$/]',
                'poste' => 'required|max_length[50]',
            ])
        ) {
            // si la validation échoue
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // récupération des données validées et nettoyées et sauvegarde des données dans la table contacts 
        $postValid = $this->validator->getValidated();

        /*
        $res = $this->model->saveContact([
            'nom' => strtoupper($postValid['nom']),
            'prenom' => ucfirst(strtolower($postValid['prenom'])),
            'email' => strtolower($postValid['email']),
            'telephone' => $postValid['telephone'],
            'poste' => ucfirst(strtolower($postValid['poste'])),
        ]); // strtoupper() et ucfirst pour respecter la casse en BD
        */


        $res = $this->model->saveContactOfUser([
            'nom' => strtoupper($postValid['nom']),
            'prenom' => ucfirst(strtolower($postValid['prenom'])),
            'email' => strtolower($postValid['email']),
            'telephone' => $postValid['telephone'],
            'poste' => ucfirst(strtolower($postValid['poste'])),
        ], session()->get('user_id'));
        // Sauvegarde du contact dans la table contacter pour l’associer à l’utilisateur connecté


        if ($res) {
            $data['contacts'] = $this->model->getContactsOfUser(session()->get('user_id'));
            $data['titre'] = 'Liste des contacts';
            $data['success'] = 'Contact ajouté avec succès !';
            return view('contacts/liste', $data);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', ['db_error' => 'Erreur lors de l\'ajout en base de données']);
        }
    }

    public function delete($num)
    {
        $this->model->delete($num);
        $data['contacts'] = $this->model->getContactsOfUser(session()->get('user_id'));
        return view('contacts/liste', $data);
    }

}