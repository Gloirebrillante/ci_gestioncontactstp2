<?php

namespace App\Controllers;
use Illuminate\Http\Request;
use App\Models\UsersModel;

class Users extends BaseController
{
        public function __construct()
    {
        $this->model = new UsersModel();
    }
    public function profil(): string
    {
        $user = $this->model->getUserById(session()->get('user_id'));
        return view('users/profil', ['user' => $user]);
    }
}
