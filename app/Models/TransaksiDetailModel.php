<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiDetailModel extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'transaksi_detail_id';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowedFields = ['order_id', 'kebutuhan_id', 'jumlah_transaksi', 'status', 'created_at', 'updated_at'];

    public function getDetail($order_id)
    {
        $this->select('transaksi.order_id, users.nama_dinas, transaksi.created_at, transaksi_detail.jumlah_transaksi, kebutuhan.nama_kebutuhan');
        $this->join('transaksi', 'transaksi.order_id = transaksi_detail.order_id');
        $this->join('kebutuhan', 'kebutuhan.kebutuhan_id = transaksi_detail.kebutuhan_id');
        $this->join('users', 'users.user_id = transaksi.user_id');
        $this->where($order_id);
        $query = $this->get();
        return $query->getResult();
    }
}
