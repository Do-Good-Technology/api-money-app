<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id_transaction';
    protected $allowedFields = [
        'id_user',
        'id_wallet',
        'nominal_transaction',
        'flow_transaction',
        'category_transaction',
        'note_transaction',
        'date_transaction',
        'is_report',
        'created_date_transaction',
        'updated_date_transaction'
    ];
    protected $useTimestamps = false;
}
