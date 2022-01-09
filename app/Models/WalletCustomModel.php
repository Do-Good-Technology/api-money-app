<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletCustomModel extends Model
{
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
