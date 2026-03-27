<?php namespace App\Models;
use CodeIgniter\Model;
class UsersModel extends Model{
protected $table = 'users';
protected $allowedFields = ['nom', 'prenom', 'email', 'password'];

protected $primaryKey = 'id';
public function getUsers()
{
    
return $this->findAll();
}
public function getUserById($id){
        return $this->find($id);
}

public function saveUser(array $user): bool
{
        return $this->save($user);
}

public function getUserByEmail(string $email)
{
    return $this->where('email', $email)->first();
}

}
?>