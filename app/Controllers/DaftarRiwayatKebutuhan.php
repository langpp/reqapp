<?php namespace App\Controllers;

use App\Models\HistoryKebutuhanModel;
use App\Models\KategoriKebutuhanModel;

class DaftarRiwayatKebutuhan extends BaseController
{
    public function index()
    {
        $model = new KategoriKebutuhanModel();
        $data = [
            "kategori_kebutuhan" => $model->findAll(),
        ];

        return view('pages/riwayat-kebutuhan', $data);
    }

    function list() {
        setlocale(LC_TIME, 'id_ID');

        $data = array();
        $req = $this->request->getVar();
        $no = $req['start'];

        $model = new HistoryKebutuhanModel();

        foreach ($model->getAll($req) as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_kebutuhan;
            $row[] = $field->deskripsi;
            $row[] = $field->nama_kategori;
            $row[] = $field->stok;
            $row[] = $field->satuan;
            $row[] = $field->harga_satuan;
            $row[] = strftime("%d %B %Y %H:%M", strtotime($field->created_at));
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
}
