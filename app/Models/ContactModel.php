<?php
namespace App\Models;
use CodeIgniter\Model;



class ContactModel extends Model
{
    protected $table = 'contacts';
    protected $allowedFields = ['nom', 'prenom', 'naissance', 'ville', 'email', 'telephone', 'poste'];
    


    // Fonction pour récupérer tous les contacts de la table contacts
    public function getContacts()
    {
        return $this->findAll();
    }



    // Fonction pour sauvegarder un nouveau contact en BDD dans la table contacts
    public function saveContact(array $contact): bool
    {
        return $this->save($contact);
    }



    // Fonction pour sauvegarder un nouveau contact en BDD
    public function getContactsOfUser($userId)
    {
        return $this->select('contacts.*')
            ->join('contacter', 'contacter.contact_id = contacts.id')
            ->where('contacter.user_id', $userId)
            ->findAll();
    }



    // Fonction pour ajouter un contact relié à un user dans la table contacter
    public function saveContactOfUser(array $contact, int $userId): bool
    {
        $db = \Config\Database::connect();
        $db->transStart(); // début d’une transaction

        $this->insert($contact);
        $contactId = $this->getInsertID();

        $contacterModel = new ContacterModel();
        $contacterModel->save([
            'contact_id' => $contactId,
            'user_id' => $userId
        ]);

        $db->transComplete(); // fin de la transaction

        return $db->transStatus(); // retourne le statut de la transaction
    }



    /*
    // Fonction pour récupérer un contact par son email
    public function getContactByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
    */

}
?>