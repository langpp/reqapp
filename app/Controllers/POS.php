<?php namespace App\Controllers;

use App\Models\KategoriKebutuhanModel;

class POS extends BaseController
{
    public function index()
    {
        $kategori_kebutuhan_model = new KategoriKebutuhanModel();

        $data = [
            "kategori_kebutuhan" => $kategori_kebutuhan_model->findAll(),
        ];

        return view('pos', $data);
    }

    //--------------------------------------------------------------------

}
