<?php
namespace App\Models;
use CodeIgniter\Model;



class ContacterModel extends Model
{

    protected $table = 'contacter';
    protected $allowedFields = ['contact_id', 'user_id', 'notes', 'statut'];}
?>