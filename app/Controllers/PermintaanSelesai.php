<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;

class PermintaanSelesai extends BaseController
{
    public function index()
    {
        return view('pages/permintaan-selesai');
    }

    function list()
    {
        $data = array();
        $req = $this->request->getVar();
        $no = $req['start'];

        $model = new TransaksiModel();

        $where = [
            'transaksi.status' => 3,
        ];

        foreach ($model->getByStatus($req, $where) as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = strftime("%d %B %Y %H:%M", strtotime($field->created_at));
            $row[] = $field->order_id;
            $row[] = $field->nama_dinas;
            $row[] = '<a type="button" class="btn btn-primary btn-xs detail" href="/permintaan-selesai/detail/' . $field->order_id . '"><i class="fa fa-eye"></i></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $req['draw'],
            "recordsTotal" => $model->countAll(),
            "recordsFiltered" => $model->countFiltered($req),
            "data" => $data,
        );

        return json_encode($output);
    }

    public function detail($id)
    {
        setlocale(LC_TIME, 'id_ID');
        $model = new TransaksiDetailModel();

        $where = [
            'transaksi_detail.order_id' => $id,
        ];

        $data = [
            'judul' => 'Permintaan Selesai',
            'permintaan' => $model->getDetail($where)
        ];

        return view('pages/detail-permintaan', $data);
    }
}
