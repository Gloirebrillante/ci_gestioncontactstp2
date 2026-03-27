<?php
namespace App\Controllers;
use App\Models\ContactModel;
use CodeIgniter\Controller;
class Contacts extends BaseController
{
 private $model;

    public function __construct()
    {
        $this->model = new ContactModel();
    }
public function index()
{
    $data = [
        'contacts' => $this->model->getContactsOfUser(session()->get('user_id')),
        'titre' => 'Liste des contacts',
        ];
    return view('contacts/liste', $data); 
}

public function create()
{
    return view('contacts/form');
}

public function store()
{
    $data = $this->request->getPost(['nom', 'prenom', 'naissance', 'ville', 'email', 'telephone', 'poste']);
    // vérification des règles de validation
    if (! $this->validateData($data, [
    'nom' => 'required|max_length[30]|min_length[3]|alpha_space',
    'prenom' => 'required|max_length[30]|min_length[2]|alpha_space',
    'email' => 'required|valid_email',
    'naissance' => 'required',
    'ville' => 'required',
    'telephone' => 'required|regex_match[/^\+?[0-9\s\-]+$/]',
    'poste' => 'required',
    ])) {
    // si la validation échoue
    return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
    }

    // récupération des données validées et nettoyées et sauvegarde des données
    $postValid = $this->validator->getValidated();

    $res=$this->model->saveContactOfUser([
        'nom' => strtoupper($postValid['nom']),
        'prenom'=> ucfirst(strtolower($postValid['prenom']) ),
        'email' => $postValid['email'],
        'naissance' => date('Y-m-d', strtotime($postValid['naissance'])),
        'ville' => strtoupper($postValid['ville']),
        'telephone' => $postValid['telephone'],
        'poste' => $postValid['poste'],
    ], session()->get('user_id')); // strtoupper() et ucfirst pour respecter la casse en BD

    if ($res){
    $data['contacts'] = $this->model->getContactsOfUser(session()->get('user_id'));
    $data['titre'] = 'Liste des contacts';
    $data['message'] = 'Contact ajouté avec succès.';
    return view('contacts/liste', $data);           
    }
    else {
        return redirect()
                ->back()
                ->withInput()
                ->with('errors', ['db_error' => 'Erreur lors de l\'ajout en base de données']);
    }
}

public function delete($num)
{
    $this->model->delete($num);
$data['contacts']=$this->model->getContactsOfUser(session()->get('user_id'));
return view('contacts/liste', $data);

}

}
