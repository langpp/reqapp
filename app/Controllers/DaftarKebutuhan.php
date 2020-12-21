<?php namespace App\Controllers;

use App\Models\DaftarKebutuhanModel;
use App\Models\KategoriKebutuhanModel;

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

        $data = [
            'kebutuhan_id' => $req['id'],
        ];

        $q = $model->getWhere($data)->getRow();

        return json_encode($q);
    }

    public function insert()
    {
        $req = $this->request->getVar();
        $model = new DaftarKebutuhanModel();
        $model2 = new HistoryKebutuhanModel();
        if ($req['pilihjenis'] == '1') {
            $arraySplit = explode(',', $req['kategori_kebutuhan_id']);
            $kategori_kebutuhan_id = $arraySplit[0];
            $kodekebutuhan = rand(1000000, 9999999);
            $data = [
                'kode_kebutuhan' => $kodekebutuhan,
                'nama_kebutuhan' => $req['nama_kebutuhan_i'],
                'deskripsi' => $req['deskripsi'],
                'kategori_kebutuhan_id' => $kategori_kebutuhan_id,
                'satuan' => $req['satuan'],
                'stok' => $req['stok'],
                'status' => $req['status'],
            ];

            $data2 = [
                'kode_kebutuhan' => $kodekebutuhan,
                'nama_kebutuhan' => $req['nama_kebutuhan_i'],
                'deskripsi' => $req['deskripsi'],
                'kategori_kebutuhan_id' => $kategori_kebutuhan_id,
                'satuan' => $req['satuan'],
                'stok' => $req['stok'],
                'status' => $req['status'],
                'harga_satuan' => $req['harga'],
            ];
            $validated = $this->validate([
                'foto' => [
                    'uploaded[foto]',
                    'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[foto,4096]',
                ],
            ]);
            $files = $this->request->getFile('foto');
            if ($validated) {
                $filename = $files->getRandomName();
                $files->move(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC') . "/", $filename);

                $image = \Config\Services::image()->withFile(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC') . "/" . $filename)->fit(256, 256, 'center')->save(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC') . "/" . $filename);

                $data['foto'] = $filename;
            } else {
                $data['foto'] = 'noimage.png';
            }

            $q = $model->insert($data);
        } else {
            $arraySplit2 = explode(',', $req['nama_kebutuhan_s']);
            $id_kebutuhan = $arraySplit2[2];
            $nama_kebutuhan = $arraySplit2[1];
            $kode_kebutuhan = $arraySplit2[0];
            $arraySplit = explode(',', $req['kategori_kebutuhan_id']);
            $kategori_kebutuhan_id = $arraySplit[0];
            $findkebutuhan = $model->where('kode_kebutuhan', $kode_kebutuhan)->first();
            $data = [
                'stok' => $findkebutuhan["stok"] + $req['stok'],
                'status' => $req['status'],
                'satuan' => $req['satuan'],
            ];
            $data2 = [
                'kode_kebutuhan' => $kode_kebutuhan,
                'nama_kebutuhan' => $nama_kebutuhan,
                'deskripsi' => $req['deskripsi'],
                'kategori_kebutuhan_id' => $kategori_kebutuhan_id,
                'satuan' => $req['satuan'],
                'stok' => $req['stok'],
                'status' => $req['status'],
                'harga_satuan' => $req['harga'],
            ];
            $q = $model->update($id_kebutuhan, $data);
        }
        $p = $model2->insert($data2);

        return json_encode($q);
    }

    public function edit()
    {
        $req = $this->request->getVar();
        $model = new DaftarKebutuhanModel();

        $files = $this->request->getFile('foto');

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
            'kategori_kebutuhan_id' => $req['kategori_kebutuhan_id'],
            'satuan' => $req['satuan'],
        ];

        if ($validated) {
            $filename = $files->getRandomName();
            $files->move(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC'), $filename);

            $image = \Config\Services::image()->withFile(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC') . "/" . $filename)->fit(256, 256, 'center')->save(ROOTPATH . "public/" . getenv('AVATAR_KEBUTUHAN_LOC') . "/" . $filename);

            $data['foto'] = $filename;
        }

        $q = $model->update($req['id'], $data);

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
            } else {
                echo "<script>alert('Data Gagal Disimpan');window.location.href = '/daftar-kebutuhan';</script>";
            }
        } else {
            echo "<script>alert('error');window.location.href = '/daftar-kebutuhan';</script>";
        }
    }
}
