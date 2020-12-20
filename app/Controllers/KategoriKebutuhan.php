<?php namespace App\Controllers;

use App\Models\KategoriKebutuhanModel;

class KategoriKebutuhan extends BaseController
{
    public function index()
    {
        return view('pages/kategori-kebutuhan');
    }

    function list() {
        $data = array();
        $req = $this->request->getVar();
        $no = $req['start'];

        $model = new KategoriKebutuhanModel();

        foreach ($model->getAll($req) as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<i class="' . $field->icon . '"></i>';
            $row[] = $field->nama_kategori;
            $row[] = '<button type="button" class="btn btn-info btn-xs edit" data-id="' . $field->kategori_kebutuhan_id . '"><i class="fa fa-pencil-alt"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-xs delete" data-id="' . $field->kategori_kebutuhan_id . '"><i class="fa fa-trash-alt"></i></button>';

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

    public function getByID()
    {
        $req = $this->request->getVar();
        $model = new KategoriKebutuhanModel();

        $data = [
            'kategori_kebutuhan_id' => $req['id'],
        ];

        $q = $model->getWhere($data)->getRow();

        return json_encode($q);
    }

    public function insert()
    {
        $req = $this->request->getVar();
        $model = new KategoriKebutuhanModel();

        $data = [
            'nama_kategori' => $req['kategori_kebutuhan'],
            'icon' => $req['icon'],
        ];

        $q = $model->insert($data);

        return json_encode($q);
    }

    public function edit()
    {
        $req = $this->request->getVar();
        $model = new KategoriKebutuhanModel();

        $data = [
            'nama_kategori' => $req['kategori_kebutuhan'],
            'icon' => $req['icon'],
        ];

        $q = $model->update($req['id'], $data);

        return json_encode($q);
    }

    public function delete()
    {
        $req = $this->request->getVar();
        $model = new KategoriKebutuhanModel();

        $q = $model->delete($req['id']);

        return json_encode($q);
    }
}
