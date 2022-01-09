<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Controllers\Auth;
use App\Models\TransactionModel;
use App\Models\WalletModel;
use stdClass;

class Mix extends ResourceController
{
    public function home()
    {
        return $this->respond("in home");
    }

    public function addTransaction($dataTransaction)
    {
        date_default_timezone_set('asia/jakarta');
        $trasactionModel = new TransactionModel();
        $userModel = new UserModel();

        $dataTransaction->created_date_transaction = date("Y-m-d H:i:s");
        $trasactionModel->save($dataTransaction);

        

        $dataUser = new stdClass();
        $dataUser->id_user = $dataTransaction->id_user;
    }

    public function addNewWallet()
    {
        date_default_timezone_set('asia/jakarta');
        $authController = new Auth();
        $walletModel = new WalletModel();
        $message = new stdClass();

        $dataRequest = $this->request->getPost();
        $resultReAuth = $authController->reAuth($dataRequest['auth']);

        if ($resultReAuth->status) {
            $data = new stdClass();
            $data->id_user = $resultReAuth->id_user;
            $data->name_wallet = $dataRequest['walletName'];
            $data->icon_wallet = $dataRequest['iconType'];
            $data->nominal_wallet = $dataRequest['currentBalance'];
            $data->type_wallet = $dataRequest['walletType'];
            $data->is_report = $dataRequest['isReport'];
            $data->created_date_wallet = date("Y-m-d H:i:s");

            if ($walletModel->save($data)) {

                $dataTransaction = new stdClass();
                $dataTransaction->id_user = $data->id_user;
                $dataTransaction->id_wallet = $walletModel->getInsertID();
                $dataTransaction->nominal_transaction = $data->nominal_wallet;
                $dataTransaction->flow_transaction = "income";
                $dataTransaction->category_transaction = "new_wallet";
                $dataTransaction->note_transaction = "New {$data->name_wallet} Wallet";
                $dataTransaction->date_transaction = date("Y-m-d H:i:s");
                $dataTransaction->is_report = $dataRequest['isReport'];
                $this->addTransaction($dataTransaction);

                $message->status = 'success';
                $message->data = $data;

                return $this->respond($message);
            } else {
                $message->status = 'failed';
                return $this->respond($message);
            }

            return $this->respond($data);
        } else {
            $message->status = 'error';
            $message->info = 'auth error';
            return $this->respond($message);
        }
    }
}
