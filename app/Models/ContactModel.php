<?php namespace App\Models;
use CodeIgniter\Model;
use App\Models\ContacterModel;
class ContactModel extends Model{
protected $table = 'contacts';
protected $allowedFields = ['nom', 'prenom','naissance','ville', 'email', 'telephone', 'poste'];

protected $primaryKey = 'id';
public function getContacts()
{
    
return $this->findAll();
}
public function saveContact(array $contact): bool
{
        return $this->save($contact);
}

public function getContactsOfUser($userId)
{
    return $this->select('contacts.*')
                ->join('contacter', 'contacter.contact_id = contacts.id')
                ->where('contacter.user_id', $userId)
                ->findAll();
}

public function saveContactOfUser(array $contact, int $userId): bool
{
    $db = \Config\Database::connect();
    $db->transStart(); // début d’une transaction

    $this->insert($contact);
    $contactId = $this->getInsertID();

    $contacterModel = new ContacterModel();
    $contacterModel->save([
        'contact_id' => $contactId,
        'user_id'    => $userId
    ]);
    $db->transComplete(); // fin de la transaction

    return $db->transStatus(); // retourne le status de la transaction
}

}
