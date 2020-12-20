<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['nama_dinas', 'alamat_dinas', 'nomor_telepon', 'email', 'password', 'role_id', 'status', 'created_at', 'updated_at'];
}
