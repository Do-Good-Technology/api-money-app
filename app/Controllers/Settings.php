<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;

class Settings extends ResourceController
{

    public function editAccount()
    {
        date_default_timezone_set('asia/jakarta');
        $userModel = new UserModel();

        $dataRequest = $this->request->getPost();

        $dataRequest['updated_date_user'] = date("Y-m-d H:i:s");

        try {
            $userModel->save($dataRequest);
            $dataUserFromDatabase = $userModel->find($dataRequest['id_user']);
            return $this->respond(['status' => 'success', 'info' => 'success change account data', 'id_user' => $dataUserFromDatabase['id_user'], 'dataUser' => $dataUserFromDatabase]);
        } catch (\Exception $e) {
            return $this->respond($e->getMessage());
        }
    }

    public function changePassword()
    {
        date_default_timezone_set('asia/jakarta');
        $userModel = new UserModel();

        $dataRequest = $this->request->getPost();

        $dataUserDatabase = $userModel->find($dataRequest['id_user']);
        $oldPasswordRequest = hash('SHA512', md5($dataRequest['old_password']));

        if ($dataUserDatabase['password_user'] == $oldPasswordRequest) {
            $dataRequest['password_user'] = hash('SHA512', md5($dataRequest['new_password']));
            $dataRequest['updated_date_user'] = date("Y-m-d H:i:s");
            $userModel->save($dataRequest);
            return $this->respond(['status' => 'success', 'info' => 'success change password', 'dataUser' => $dataUserDatabase]);
        } else {
            return $this->respond(['status' => 'failed', 'info' => 'old password wrong', 'dataUser' => $dataUserDatabase]);
        }
    }
}
