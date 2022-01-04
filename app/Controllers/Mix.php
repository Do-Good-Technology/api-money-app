<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;


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
        $dataRequest = $this->request->getPost();

        $this->addTransaction();

        return $this->respond($dataRequest);
    }
}
