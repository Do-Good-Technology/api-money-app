<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Controllers\Auth;

class Mix extends ResourceController
{
    protected function addTransaction()
    {
    }

    public function home()
    {
        return $this->respond("in home");
    }

    public function addNewWallet()
    {
        $auth = new Auth();

        $authJsonString = '{ "id_user": "10", "email_user": "asd1@asd.asd","hash_password_user":"f5b3b9b303f5a0594272f99d191bbf45"}';

        return $this->respond($auth->reAuth($authJsonString));

        // $dataRequest = $this->request->getPost();

        // $this->addTransaction();

        // return $this->respond($dataRequest);
    }
}
