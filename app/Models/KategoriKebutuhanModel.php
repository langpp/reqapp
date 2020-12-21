<?php namespace App\Models;

use CodeIgniter\Model;

class KategoriKebutuhanModel extends Model
{
    protected $table = 'kategori_kebutuhan';
    protected $primaryKey = 'kategori_kebutuhan_id';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowedFields = ['kode_kategori', 'nama_kategori', 'icon', 'status', 'created_at', 'updated_at'];

    protected $column_order = array(null, 'kode_kategori', 'nama_kategori', 'icon');
    protected $column_search = array('kode_kategori', 'nama_kategori');
    protected $order = array('nama_kategori' => 'asc');

    public function getAll($req)
    {
        $this->getDatatableQuery($req);
        if ($req['length'] != -1) {
            $this->limit($req['length'], $req['start']);
        }

        $query = $this->get();
        return $query->getResult();
    }

    public function getDatatableQuery($req)
    {
        $i = 0;

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
