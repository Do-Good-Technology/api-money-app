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

    public function register()
    {
        date_default_timezone_set('asia/jakarta');

        $userModel = new UserModel();

        $dataRequest = $this->request->getPost();

        // * check if there is another email
        if (count($userModel->where('email_user', $dataRequest['email_user'])->findAll()) > 0) {
            return $this->respond(['status' => 'failed', 'info' => 'email already has registered']);
        } else {
            $data = $dataRequest;
            $data['password_user'] = hash('SHA512', md5($dataRequest['password_user']));
            $data['created_date_user'] = date("Y-m-d H:i:s");

            if ($userModel->save($data)) {
                $idUser = $userModel->getInsertID();
                return $this->respond(['status' => 'success', 'info' => 'new account already registered', 'id_user' => $idUser, 'dataUser' => $data]);
            }
        }
    }

    public function login()
    {
        $userModel = new UserModel();

        $dataRequest = $this->request->getPost();
        $dataUserFromDatabase = $userModel->where('email_user', $dataRequest['email_user'])->findAll();
        if (count($dataUserFromDatabase) == 0) {
            return $this->respond(['status' => 'failed', 'info' => 'email is not registered', 'id_user' => "", 'dataAdmin' => ""]);
        } else {
            if (hash('SHA512', md5($dataRequest['password_user'])) == $dataUserFromDatabase[0]['password_user']) {
                return $this->respond(['status' => 'success', 'info' => 'email & password are correct', 'id_user' => $dataUserFromDatabase[0]['id_user'], 'dataUser' => $dataUserFromDatabase[0]]);
            } else {
                return $this->respond(['status' => 'failed', 'info' => 'email is correct, password is incorrect', 'id_user' => $dataUserFromDatabase[0]['id_user'], 'dataUser' => ""]);
            }
        }
    }
}
