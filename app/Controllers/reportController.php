<?php namespace App\Controllers;

// require '/vendor/autoload.php';
use App\Models\DaftarKebutuhanModel;
use App\Models\HistoryKebutuhanModel;
use App\Models\TransaksiModel;

class reportController extends BaseController
{
    public function index()
    {
        return view('report/report');
    }

    public function exportKebutuhan()
    {
        $model = new DaftarKebutuhanModel();
        $data = [
            "kebutuhan" => $model->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan.kategori_kebutuhan_id')->findAll(),
        ];
        return view('report/exportkebutuhan', $data);
    }

    public function exportKebutuhanHistory()
    {
        $model = new HistoryKebutuhanModel();
        $data = [
            "kebutuhan" => $model->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan_history.kategori_kebutuhan_id')->findAll(),
        ];
        return view('report/exportkebutuhanhistory', $data);
    }

    public function exportTransaksi()
    {
        $model = new TransaksiModel();
        $kebutuhan = $model->join('users', 'users.user_id = transaksi.user_id')->findAll();
        $sendData = [];
        foreach ($kebutuhan as $data) {
            $transaksi_detail = $model->join('transaksi_detail', 'transaksi_detail.order_id = transaksi.order_id')->join('kebutuhan', 'kebutuhan.kebutuhan_id = transaksi_detail.kebutuhan_id')->where('transaksi_detail.order_id', $data['order_id'])->findAll();

            $array = [
                'order_id' => $data['order_id'],
                'status' => $data['status'],
                'created_at' => $data['created_at'],
                'nama_dinas' => $data['nama_dinas'],
                'many' => $transaksi_detail,
            ];
            $sendData[] = $array;
        }

        $data = [
            "kebutuhan" => $sendData,
        ];
        return view('report/exporttransaksi', $data);
    }

    public function excelTemplate()
    {
        $model = new DaftarKebutuhanModel();
        $data = [
            "kebutuhan" => $model->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan.kategori_kebutuhan_id')->findAll(),
        ];
        return view('report/exceltemplate', $data);
    }
}
