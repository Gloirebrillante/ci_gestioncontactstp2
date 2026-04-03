<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class Pages extends BaseController
{

    public function afficher($page = 'accueil')
    {
        if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
            // la page n’existe pas
            throw new
                \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        return view('pages/' . $page); // charge la vue demandée
    }
}