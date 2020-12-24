<?php namespace App\Controllers;

use App\Models\DaftarKebutuhanModel;
use App\Models\KategoriKebutuhanModel;
use App\Models\HistoryKebutuhanModel;

class DaftarKebutuhan extends BaseController
{
    public function index()
    {
        $model = new KategoriKebutuhanModel();
        $model2 = new DaftarKebutuhanModel();
        $data = [
            "kategori_kebutuhan" => $model->findAll(),
            "kebutuhan" => $model2->findAll(),
        ];

        return view('pages/daftar-kebutuhan', $data);
    }

    function list() {
        $data = array();
        $req = $this->request->getVar();
        $no = $req['start'];

        $model = new DaftarKebutuhanModel();

        foreach ($model->getAll($req) as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<img src="' . base_url(getenv('AVATAR_KEBUTUHAN_LOC') . "/" . $field->foto) . '" style="width: 32px">';
            $row[] = $field->nama_kebutuhan;
            $row[] = $field->deskripsi;
            $row[] = $field->nama_kategori;
            $row[] = $field->stok;
            $row[] = $field->satuan;
            $row[] = '<button type="button" class="btn btn-info btn-xs edit" data-id="' . $field->kebutuhan_id . '"><i class="fa fa-pencil-alt"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-xs delete" data-id="' . $field->kebutuhan_id . '"><i class="fa fa-trash-alt"></i></button>';

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

    public function getData()
    {
        $model = new DaftarKebutuhanModel();
        $req = $this->request->getVar();
        $q = null;

        if ($req['kategori_id']) {
            $data = [
                'kebutuhan.kategori_kebutuhan_id' => $req['kategori_id'],
            ];

            $q = $model->select('kebutuhan_id, nama_kebutuhan, deskripsi, satuan, foto, nama_kategori, stok')->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan.kategori_kebutuhan_id')->getWhere($data)->getResult();

        } else {
            $q = $model->select('kebutuhan_id, nama_kebutuhan, deskripsi, satuan, foto, nama_kategori, stok')->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan.kategori_kebutuhan_id')->findAll();
        }

        return json_encode($q);
    }

    public function getByID()
    {
        $req = $this->request->getVar();
        $model = new DaftarKebutuhanModel();
        $model->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan.kategori_kebutuhan_id');
        $data = [
            'kebutuhan_id' => $req['id'],
        ];

        $q = $model->getWhere($data)->getRow();

        return json_encode($q);
    }

    public function getAllKebutuhan()
    {
        $model = new DaftarKebutuhanModel();

        $q = $model->findAll();

        return json_encode($q);
    }

    public function getAllKategori()
    {
        $model = new KategoriKebutuhanModel();


        $q = $model->findAll();

        return json_encode($q);
    }

    public function insert()
    {
        $req = $this->request->getVar();
        $model = new DaftarKebutuhanModel();
        $model2 = new HistoryKebutuhanModel();
        $files = $this->request->getFileMultiple('foto');
        
        for ($x = 0; $x < count($files); $x++) {
            if ($req['pilihjenis'][$x] == '1') {
                $arraySplit = explode(', ', $req['kategori_kebutuhan_id'][$x]);
                $kategori_kebutuhan_id = $arraySplit[0];
                $lastid = $model->orderBy('kebutuhan_id',"desc")->findAll();
                if(!empty($lastid)){
                    $sendid = $lastid[0]['kebutuhan_id'];
                }else{
                    $sendid = 0;
                }
                $data = [
                    'kode_kebutuhan' => $arraySplit[1] . '-' . ($sendid+1),
                    'nama_kebutuhan' => $req['nama_kebutuhan_i'][$x],
                    'deskripsi' => $req['deskripsi'][$x],
                    'kategori_kebutuhan_id' => $kategori_kebutuhan_id,
                    'satuan' => $req['satuan'][$x],
                    'stok' => $req['stok'][$x],
                    'status' => 1,
                    // 'status' => $req['status'][$x],
                    'created_at' => $req['tanggal'][$x],
                ];

                if (!empty($files[$x])) {
                    $filename = $files[$x]->getRandomName();
                    $files[$x]->move(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC') . "/", $filename);

                    $image = \Config\Services::image()->withFile(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC') . "/" . $filename)->fit(256, 256, 'center')->save(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC') . "/" . $filename);

                    $data['foto'] = $filename;
                } else {
                    $data['foto'] = 'noimage.png';
                }
                $q = $model->insert($data);
                $data2 = [
                    'kode_kebutuhan' => $arraySplit[1] . '-' . ($sendid + 1),
                    'kebutuhan_id' => $model->getInsertID(),
                    'nama_kebutuhan' => $req['nama_kebutuhan_i'][$x],
                    'deskripsi' => $req['deskripsi'][$x],
                    'kategori_kebutuhan_id' => $kategori_kebutuhan_id,
                    'satuan' => $req['satuan'][$x],
                    'stok' => $req['stok'][$x],
                    'status' => 1,
                    // 'status' => $req['status'][$x],
                    'harga_satuan' => $req['harga'][$x],
                    'created_at' => $req['tanggal'][$x],
                ];
                // $validated = $this->validate([
                //     'foto' => [
                //         'uploaded[foto]',
                //         'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
                //         'max_size[foto,4096]',
                //     ],
                // ]);
                // if ($validated) {
                $p = $model2->insert($data2);
            } else {
                $arraySplit2 = explode(', ', $req['nama_kebutuhan_s'][$x]);
                $arraySplit = explode(', ', $req['kategori_kebutuhan_id'][$x]);
                $findkebutuhan = $model->where('kebutuhan_id', $arraySplit2[2])->first();
                $data = [
                    'stok' => $findkebutuhan["stok"] + $req['stok'][$x],
                    // 'status' => $req['status'][$x],
                    'satuan' => $req['satuan'][$x],
                ];
                $data2 = [
                    'kode_kebutuhan' => $arraySplit2[0],
                    'kebutuhan_id' => $arraySplit2[2],
                    'nama_kebutuhan' => $arraySplit2[1],
                    'deskripsi' => $req['deskripsi'][$x],
                    'kategori_kebutuhan_id' => $arraySplit2[3],
                    'satuan' => $req['satuan'][$x],
                    'stok' => $req['stok'][$x],
                    'status' => 1,
                    // 'status' => $req['status'],
                    'harga_satuan' => $req['harga'][$x],
                    'created_at' => $req['tanggal'][$x],
                ];
                $q = $model->update($arraySplit2[2], $data);
                $p = $model2->insert($data2);
            }
        }
        return json_encode($q);
    }

    public function edit()
    {
        $req = $this->request->getVar();
        $model = new DaftarKebutuhanModel();
        $model2 = new HistoryKebutuhanModel();

        $files = $this->request->getFile('foto');
        $findkebutuhan = $model->where('kebutuhan_id', $req['id'])->first();

        $arraySplit = explode(', ', $req['kategori_kebutuhan_id']);
        $arraySplit2 = explode('-', $findkebutuhan['kode_kebutuhan']);
        $validated = $this->validate([
            'foto' => [
                'uploaded[foto]',
                'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[foto,4096]',
            ],
        ]);

        $data = [
            'nama_kebutuhan' => $req['nama_kebutuhan'],
            'deskripsi' => $req['deskripsi'],
            'kategori_kebutuhan_id' => $arraySplit[0],
            'kode_kebutuhan' => $arraySplit[1] . '-' . $arraySplit2[1],
            'satuan' => $req['satuan'],
            'created_at' => $req['tanggal'],
        ];

        $data2 = [
            'kategori_kebutuhan_id' => $arraySplit[0],
            'kode_kebutuhan' => $arraySplit[1] . '-' . $arraySplit2[1],
        ];

        if ($validated) {
            $filename = $files->getRandomName();
            $files->move(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC'), $filename);

            $image = \Config\Services::image()->withFile(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC') . "/" . $filename)->fit(256, 256, 'center')->save(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC') . "/" . $filename);

            $data['foto'] = $filename;
        }

        $q = $model->update($req['id'], $data);
        $model2->set($data2);
        $p = $model2->where('kebutuhan_id', $req['id'])->update();

        return json_encode($q);
    }

    public function delete()
    {
        $req = $this->request->getVar();
        $model = new DaftarKebutuhanModel();

        $q = $model->delete($req['id']);

        return json_encode($q);
    }

    public function uploadKebutuhan()
    {
        $model = new DaftarKebutuhanModel();
        $model2 = new HistoryKebutuhanModel();
        $model3 = new KategoriKebutuhanModel();
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
            for ($i = 1; $i < count($sheetData); $i++) {
                $findkebutuhan = $model->where('kebutuhan_id', $sheetData[$i][0])->first();
                if (!empty($findkebutuhan)) {
                    $updatedata = array(
                        'stok' => $findkebutuhan['stok'] + $sheetData[$i][4],
                    );
                    $model->update($sheetData[$i][0], $updatedata);
                    $data2 = [
                        'kode_kebutuhan' => $findkebutuhan['kode_kebutuhan'],
                        'kebutuhan_id' => $sheetData[$i][0],
                        'nama_kebutuhan' => $findkebutuhan['nama_kebutuhan'],
                        'deskripsi' => $sheetData[$i][3],
                        'kategori_kebutuhan_id' => $findkebutuhan['kategori_kebutuhan_id'],
                        'satuan' => $sheetData[$i][5],
                        'stok' => $sheetData[$i][4],
                        'status' => 1,
                        'harga_satuan' => $sheetData[$i][6],
                        'created_at' => $sheetData[$i][7],
                    ];
                    $tambah2 = $model2->insert($data2);
                }else{
                    $lastid = $model->orderBy('kebutuhan_id',"desc")->findAll();
                    if(!empty($lastid)){
                        $sendid = $lastid[0]['kebutuhan_id'];
                    }else{
                        $sendid = 0;
                    }
                    $kategori_id_find = $model3->where('kode_kategori', $sheetData[$i][2])->first();
                    $kategori_id_all = $model3->first();
                    if (!empty($kategori_id_find['kode_kategori'])) {
                        $kat_id = $kategori_id_find['kategori_kebutuhan_id'];
                    }else{
                        $kat_id = $kategori_id_all['kategori_kebutuhan_id'];
                    }
                    $data = [
                        'kode_kebutuhan' => $sheetData[$i][2] . '-' . ($sendid+1),
                        'nama_kebutuhan' => $sheetData[$i][1],
                        'deskripsi' => $sheetData[$i][3],
                        'kategori_kebutuhan_id' => $kat_id,
                        'satuan' => $sheetData[$i][5],
                        'stok' => $sheetData[$i][4],
                        'status' => 1,
                        // 'status' => $req['status'][$x],
                        'created_at' => $sheetData[$i][7],
                        'foto' => 'noimage.png',
                    ];
                    $q = $model->insert($data);
                    $data2 = [
                        'kode_kebutuhan' => $sheetData[$i][2] . '-' . ($sendid+1),
                        'kebutuhan_id' => $model->getInsertID(),
                        'nama_kebutuhan' => $sheetData[$i][1],
                        'deskripsi' => $sheetData[$i][3],
                        'kategori_kebutuhan_id' => $kat_id,
                        'satuan' => $sheetData[$i][5],
                        'stok' => $sheetData[$i][4],
                        'status' => 1,
                        'harga_satuan' => $sheetData[$i][6],
                        'created_at' => $sheetData[$i][7],
                    ];
                    $tambah2 = $model2->insert($data2);
                }
                }

            if ($tambah2) {
                echo "<script>alert('Data Berhasil Disimpan');window.location.href = '/daftar-kebutuhan';</script>";
            } else {
                echo "<script>alert('Data Gagal Disimpan');window.location.href = '/daftar-kebutuhan';</script>";
            }
        } else {
            echo "<script>alert('error');window.location.href = '/daftar-kebutuhan';</script>";
        }
    }
}
