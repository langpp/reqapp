<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    protected $useTimestamps = true;
    protected $updatedField = 'updated_at';
    protected $allowedFields = ['order_id', 'user_id', 'status', 'created_at', 'updated_at'];

    protected $column_order = array(null, 'order_id');
    protected $column_search = array('order_id');
    protected $order = array('order_id' => 'asc');

    public function getAll($req)
    {
        $this->getDatatableQuery($req);
        if ($req['length'] != -1) {
            $this->limit($req['length'], $req['start']);
        }
        $query = $this->get();
        return $query->getResult();
    }

    public function getByStatus($req, $where)
    {
        $this->select('transaksi.*, users.nama_dinas');
        $this->getDatatableQuery($req);
        if ($req['length'] != -1) {
            $this->limit($req['length'], $req['start']);
        }
        $this->where($where);
        $query = $this->get();
        return $query->getResult();
    }

    public function getDatatableQuery($req)
    {
        $i = 0;

        $this->join('users', 'users.user_id = transaksi.user_id');

        foreach ($this->column_search as $item) {
            if ($req['search']['value']) {

                if ($i === 0) {
                    $this->groupStart();
                    $this->like($item, $req['search']['value']);
                } else {
                    $this->orLike($item, $req['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->groupEnd();
                }
            }
            $i++;
        }

        if (isset($req['order'])) {
            $this->orderBy($this->column_order[$req['order']['0']['column']], $req['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->orderBy(key($order), $order[key($order)]);
        }
    }

    public function countFiltered($req)
    {
        $this->getDatatableQuery($req);
        return $this->countAll();
    }

    public function updateData($where, $data)
    {
        $this->where($where);
        return $this->update($data);
    }
}
