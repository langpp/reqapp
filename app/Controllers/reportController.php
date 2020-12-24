<?php namespace App\Controllers;

use App\Models\DaftarKebutuhanModel;
use App\Models\HistoryKebutuhanModel;
use App\Models\TransaksiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

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
        $phpExcel = new Spreadsheet();
        $phpExcel->setActiveSheetIndex(0)
         ->setCellValue('A1','ID Kebutuhan')
         ->setCellValue('B1','Nama Kebutuhan')
         ->setCellValue('C1','Kategori')
         ->setCellValue('D1','Deskripsi')
         ->setCellValue('E1','Stok')
         ->setCellValue('F1','Satuan')
         ->setCellValue('G1','Harga')
         ->setCellValue('H1','Tanggal');
        $model = new DaftarKebutuhanModel();
        $kebutuhan= $model->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan.kategori_kebutuhan_id')->findAll();
        if(!empty($kebutuhan)){
        $col = 2;
        foreach ($kebutuhan as $data) {
            $arraySplit = explode('-', $data['kode_kebutuhan']);
            $phpExcel->setActiveSheetIndex(0)
                    ->setCellValueByColumnAndRow( 1 , $col , $data['kebutuhan_id'])
                    ->setCellValueByColumnAndRow( 2 , $col , $data['nama_kebutuhan'])
                    ->setCellValueByColumnAndRow( 3 , $col , $arraySplit[0])
                    ->setCellValueByColumnAndRow( 4 , $col , "")
                    ->setCellValueByColumnAndRow( 5 , $col , "")
                    ->setCellValueByColumnAndRow( 6 , $col , "")
                    ->setCellValueByColumnAndRow( 7 , $col , "")
                    ->setCellValueByColumnAndRow( 8 , $col , date('Y-m-d H:i:s'));
            $col++;
        }
        $fileName = 'templateUpload';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($phpExcel);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
        }else{
            $phpExcel->setActiveSheetIndex(0)
                    ->setCellValueByColumnAndRow( 1 , 2 , "")
                    ->setCellValueByColumnAndRow( 2 , 2 , "")
                    ->setCellValueByColumnAndRow( 3 , 2 , "")
                    ->setCellValueByColumnAndRow( 4 , 2 , "")
                    ->setCellValueByColumnAndRow( 5 , 2 , "")
                    ->setCellValueByColumnAndRow( 6 , 2 , "")
                    ->setCellValueByColumnAndRow( 7 , 2 , "")
                    ->setCellValueByColumnAndRow( 8 , 2 , date('Y-m-d H:i:s'));
                    $writer = new Xlsx($phpExcel);
        $fileName = 'templateUpload';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($phpExcel);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
        }
    }
}
