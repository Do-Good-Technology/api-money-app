<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'id_user',
        'name_user',
        'email_user',
        'password_user',
        'created_date_user',
        'updated_date_user'
    ];
    protected $useTimestamps = false;
}
