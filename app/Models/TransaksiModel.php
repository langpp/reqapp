<?php namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowedFields = ['transaksi_id', 'order_id', 'status', 'user_id', 'created_at', 'updated_at'];

    protected $column_order = array(null, 'order_id', 'user_id');
    protected $column_search = array('order_id', 'user_id');
    protected $order = array('order_id' => 'asc');

}
