<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id','first_name','last_name','role_name','phone_number','class_id', 'gender','email', 'password', 'created_at', 'updated_at'];
}
