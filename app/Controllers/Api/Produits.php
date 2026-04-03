<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Produits extends ResourceController
{

    protected $modelName = 'App\Models\ProduitModel';
    protected $format = 'json'; // toutes les réponses seront en JSON

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $produits = $this->model->findAll();
    return $this->respond([
        'status'   => true,
        'message'  => 'Liste des produits',
        'produits' => $produits,
    ], 200); 

    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $produits = $this->model->find($id);

        if(empty($produits)){
            return $this->respond([
                'status'   => false,
                'message'  => 'Aucun produit trouvé pour l\'id '.$id,
            ], 404); 
        }else{
        return $this->respond([
        'status'   => true,
        'message'  => 'Information du produit n°'.$id,
        'produits' => $produits,
    ], 200); 
    }
    }



    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $json= $this->request->getJson(true); 
        print_r ($json);
    }



    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
