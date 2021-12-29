<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\AuthModel;
use App\Models\UserModel;
use stdClass;

class Auth extends ResourceController
{
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

                $auth = new stdClass();
                $auth->id_user =  $idUser;
                $auth->email_user = $dataRequest['email_user'];
                $auth->hash_password_user = $dataRequest['password_user'];

                return $this->respond([
                    'status' => 'success',
                    'info' => 'new account already registered',
                    'auth' => $auth
                ]);
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
                $auth = new stdClass();
                $auth->id_user =  $dataUserFromDatabase[0]['id_user'];
                $auth->email_user = $dataRequest['email_user'];
                $auth->hash_password_user = $dataRequest['password_user'];

                return $this->respond([
                    'status' => 'success',
                    'info' => 'email & password are correct',
                    'auth' => $auth,
                ]);
            } else {
                return $this->respond(['status' => 'failed', 'info' => 'email is correct, password is incorrect', 'id_user' => '', 'dataUser' => ""]);
            }
        }
    }
}
