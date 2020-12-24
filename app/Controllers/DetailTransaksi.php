<?php

namespace App\Controllers;

use App\Models\TransaksiDetailModel;

class DetailTransaksi extends BaseController
{
    public function index()
    {
    }

    public function detail()
    {
        $model = new TransaksiDetailModel();

        $req = $this->request->getVar();

        $where = [
            'transaksi_detail.order_id' => $req['order_id'],
        ];

        $q = $model->join('kebutuhan', 'kebutuhan.kebutuhan_id = transaksi_detail.kebutuhan_id')->where($where)->orderBy('order_id', 'desc')->findAll();

        return json_encode($q);
    }
}
