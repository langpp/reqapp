<?php namespace App\Controllers;

use App\Models\DaftarKebutuhanModel;
use App\Models\KategoriKebutuhanModel;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;

class POS extends BaseController
{
    public function index()
    {
        $model = new TransaksiModel();
        $kategori_kebutuhan_model = new KategoriKebutuhanModel();
        $model_detail = new TransaksiDetailModel();

        $data = [
            "transaksi" => $model->where('user_id', session()->get('user_id'))->orderBy('created_at', 'asc')->findAll(),
            "kategori_kebutuhan" => $kategori_kebutuhan_model->findAll(),
        ];

        return view('pos', $data);
    }

    public function insert()
    {
        $model = new TransaksiModel();
        $model_detail = new TransaksiDetailModel();
        $model_kebutuhan = new DaftarKebutuhanModel();

        $req = $this->request->getVar();

        for ($i = 0; $i < count($req['kebutuhan_id']); $i++) {
            $sisa_stok[$i] = $model_kebutuhan->select('stok')->where('kebutuhan_id', $req['kebutuhan_id'][$i])->first();

            if ($sisa_stok[$i]['stok'] < (int) $req['jumlah_transaksi'][$i]) {
                return json_encode(["error" => true]);
            }
        }

        $max_id = $model->select('MAX(transaksi_id) as max')->first();

        $order_id = "#" . sprintf('%06d', ($max_id['max'] + 1));

        $data = [
            'order_id' => $order_id,
            'user_id' => session()->get('user_id'),
            'created_at' => $req['tanggal_order'] . ' ' . date('H:i:s'),
        ];

        $q = $model->insert($data);

        for ($j = 0; $j < count($req['kebutuhan_id']); $j++) {
            $p = $model_kebutuhan->update($req['kebutuhan_id'][$j], ["stok" => ($sisa_stok[$j]['stok'] - (int) $req['jumlah_transaksi'][$j])]);

            $data_detail = [
                'order_id' => $order_id,
                'kebutuhan_id' => $req['kebutuhan_id'][$j],
                'jumlah_transaksi' => $req['jumlah_transaksi'][$j],
            ];

            $r = $model_detail->insert($data_detail);
        }

        return json_encode($q);
    }

    //--------------------------------------------------------------------

}
