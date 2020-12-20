<?php namespace App\Controllers;

// require '/vendor/autoload.php';
use App\Models\DaftarKebutuhanModel;
use App\Models\KategoriKebutuhanModel;
use App\Models\HistoryKebutuhanModel;
use App\Models\TransaksiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class gilangController extends BaseController
{
	public function index()
    {
        return view('report/report');
    }

    public function exportkebutuhan()
    {
        $model = new DaftarKebutuhanModel();
        $data = [
            "kebutuhan" => $model->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan.kategori_kebutuhan_id')->findAll(),
        ];
        return view('report/exportkebutuhan', $data);
    }

    public function exportkebutuhanhistory()
    {
        $model = new HistoryKebutuhanModel();
        $data = [
            "kebutuhan" => $model->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan_history.kategori_kebutuhan_id')->findAll(),
        ];
        return view('report/exportkebutuhanhistory', $data);
    }

    public function exporttransaksi()
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
            "kebutuhan" => $sendData
        ];
        return view('report/exporttransaksi', $data);
    }

    public function exceltemplate()
    {
        $model = new DaftarKebutuhanModel();
        $data = [
            "kebutuhan" => $model->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan.kategori_kebutuhan_id')->findAll(),
        ];
        return view('report/exceltemplate', $data);
    }

    public function uploadkebutuhan(){
        $model = new DaftarKebutuhanModel();
        $model2 = new HistoryKebutuhanModel();
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if (isset($_FILES['filex']['name']) && in_array($_FILES['filex']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['filex']['name']);
            $extension = end($arr_file);
            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['filex']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $tambahData = array();
            $tambahData2 = array();
            for ($i=1; $i < count($sheetData); $i++) {
                $findkebutuhan = $model->where('kode_kebutuhan', $sheetData[$i][1])->first();
                $updatedata = array(
                    'status' => $sheetData[$i][7],
                    'satuan' => $sheetData[$i][6],
                    'stok' => $findkebutuhan['stok'] + $sheetData[$i][5],
                );
                $model->update($sheetData[$i][0], $updatedata);
                array_push($tambahData2, array(
                    'kode_kebutuhan' => $sheetData[$i][1],
                    'nama_kebutuhan' => $sheetData[$i][2],
                    'deskripsi' => $sheetData[$i][4],
                    'kategori_kebutuhan_id' => $sheetData[$i][3],
                    'satuan' => $sheetData[$i][6],
                    'stok' => $sheetData[$i][5],
                    'status' => $sheetData[$i][7],
                    'harga_satuan' => $sheetData[$i][8],
                ));
            }

            $tambah2 = $model2->insertBatch($tambahData2);
            if ($tambah2) {
                echo "<script>alert('Data Berhasil Disimpan');window.location.href = '/daftar-kebutuhan';</script>";
            }else{
                echo "<script>alert('Data Gagal Disimpan');window.location.href = '/daftar-kebutuhan';</script>";
            }
        }else{
            echo "<script>alert('error');window.location.href = '/daftar-kebutuhan';</script>";
        }
    }
}

?>