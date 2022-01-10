<?php

namespace App\Controllers;

use App\Models\MixCustomModel;
use App\Models\WalletCustomModel;
use CodeIgniter\RESTful\ResourceController;

use stdClass;

class Wallet extends ResourceController
{
    public function showWalletPage()
    {
        $mixCustomModel = new MixCustomModel();
        $authController = new Auth();
        $walletCustomModel = new WalletCustomModel();

        $message = new stdClass();

        $dataRequest = $this->request->getPost();
        $resultReAuth = $authController->reAuth($dataRequest['auth']);
        if (!$resultReAuth->status) {
            $message->status = 'error';
            $message->info = 'auth error';
            return $this->respond($message);
        }

        $message->balanceTotal = $mixCustomModel->getTotalBalance($resultReAuth->id_user);
        $message->walletListData = $walletCustomModel->getWalletListData($resultReAuth->id_user);

        return $this->respond($message);
    }
}
