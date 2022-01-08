<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Controllers\Auth;
use App\Models\WalletModel;
use stdClass;

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
