<?php

namespace App\Models;

use CodeIgniter\Model;

class MixCustomModel extends Model
{
    public function getTotalBalance($idUser)
    {
        $sql = "Select total_balance
            from user
            where {$idUser}";
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    public function getWalletListData($idUser = null)
    {
        $sql = "Select * 
            from wallet
            where {$idUser}
            order by name_wallet";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}
