<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Controllers\Auth;
use App\Models\MixCustomModel;
use App\Models\TransactionModel;
use App\Models\WalletModel;
use stdClass;

class Transaction extends ResourceController
{
    public function addTransaction()
    {
        $authController = new Auth();

        $dataRequest = $this->request->getPost();
        $resultReAuth = $authController->reAuth($dataRequest['auth']);

        return $this->respond($resultReAuth);
    }
}
