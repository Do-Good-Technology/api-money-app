<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model
{
    protected $table = 'wallet';
    protected $primaryKey = 'id_wallet';
    protected $allowedFields = [
        'id_wallet',
        'id_user',
        'name_wallet',
        'icon_wallet',
        'nominal_wallet',
        'type_wallet',
        'is_report',
        'created_date_wallet',
        'updated_date_wallet'
    ];
    protected $useTimestamps = false;
}
