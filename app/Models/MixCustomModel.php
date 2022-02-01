<?php

namespace App\Models;

use CodeIgniter\Model;

class MixCustomModel extends Model
{
    public function getTotalBalance($idUser)
    {
        $sql = "Select total_balance_user
            from user
            where id_user = {$idUser}";
        $query = $this->db->query($sql);
        $data = $query->getResult();
        return $data[0]->total_balance_user;
    }

    public function getCurrentNominalWallet($idWallet)
    {
        $sql = "Select nominal_wallet
        from wallet
        where id_wallet = {$idWallet}";
        $query = $this->db->query($sql);
        $data = $query->getResult();
        return $data[0]->nominal_wallet;
    }
}
