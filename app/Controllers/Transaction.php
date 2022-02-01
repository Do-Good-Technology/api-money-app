<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Controllers\Auth;
use App\Controllers\Mix;
use App\Models\TransactionModel;
use App\Models\WalletModel;
use stdClass;

class Transaction extends ResourceController
{
    public function addTransaction()
    {
        $authController = new Auth();
        $mixController = new Mix();

        $dataRequest = $this->request->getPost();
        $resultReAuth = $authController->reAuth($dataRequest['auth']);

        $dataTransaction = new stdClass();
        $dataTransaction->id_user = $resultReAuth->id_user;
        $dataTransaction->id_wallet = $dataRequest['idWallet'];
        $dataTransaction->nominal_transaction = $dataRequest['nominalTransaction'];
        $dataTransaction->flow_transaction = $dataRequest['flowTransaction'];
        $dataTransaction->category_transaction = $dataRequest['categoryTransaction'];
        $dataTransaction->note_transaction = $dataRequest['noteTransaction'];
        $dataTransaction->date_transaction = $dataRequest['dateTransaction'];
        $dataTransaction->is_report = $dataRequest['isReport'];
        $mixController->addTransactionHelper($dataTransaction);

        return $this->respond($dataTransaction);
    }
}
