<?php
namespace App\Models;
use CodeIgniter\Model;

class ProduitModel extends Model
{

    protected $table = 'produits';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = ['nom', 'prix', 'description'];

    // Règles de validation intégrées (bonnes pratiques CI4)
    protected $validationRules = [
        'nom' => 'required|min_length[2]|max_length[50]',
        'prix' => 'required|integer|greater_than[0]',
    ];

    protected $validationMessages = [
        'nom' => ['required' => 'Le nom du produit est obligatoire.'],
        'prix' => [
            'required' => 'Le prix est obligatoire.',
            'greater_than' => 'Le prix doit être supérieur à 0.',
        ],
    ];

    protected $skipValidation = false;

}
?>