<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;

class Home extends BaseController
{
    public function index()
    {
        $modelTransaksi = new TransaksiModel();

        $permintaanMasuk = $modelTransaksi->getWhere(array('status' => '1'))->getResult();
        $permintaanDiproses = $modelTransaksi->getWhere(array('status' => '2'))->getResult();
        $permintaanSelesai = $modelTransaksi->getWhere(array('status' => '3'))->getResult();
        $permintaanDitolak = $modelTransaksi->getWhere(array('status' => '4'))->getResult();
        $permintaanTerbaru = $modelTransaksi->getWhere(array('status' => '1'), 10)->getResult();

        $data = [
            'permintaanMasuk' => $permintaanMasuk,
            'permintaanDiproses' => $permintaanDiproses,
            'permintaanSelesai' => $permintaanSelesai,
            'permintaanDitolak' => $permintaanDitolak,
            'permintaanTerbaru' => $permintaanTerbaru
        ];
        return view('pages/home', $data);
    }

    public function getPermintaanTerbanyak()
    {
        $modelDetail = new TransaksiDetailModel();
        $data = $modelDetail->query("SELECT transaksi_detail.kebutuhan_id, nama_kebutuhan, sum(jumlah_transaksi) as total FROM `transaksi_detail` join kebutuhan ON kebutuhan.kebutuhan_id = transaksi_detail.kebutuhan_id GROUP BY transaksi_detail.kebutuhan_id")->getResult();

        $arr = [];
        foreach ($data as $x) {
            $arr[] = [$x->nama_kebutuhan, intval($x->total)];
        }

        return json_encode($arr);
    }
}
