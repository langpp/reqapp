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

    public function riwayat()
    {
        $model = new KategoriKebutuhanModel();
        $data = [
            "kategori_kebutuhan" => $model->findAll(),
        ];

        return view('pages/riwayat-kebutuhan', $data);
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

    function listriwayat() {
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

            $q = $model->select('kebutuhan_id, nama_kebutuhan, deskripsi, satuan, foto, nama_kategori')->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan.kategori_kebutuhan_id')->getWhere($data)->getResult();

        } else {
            $q = $model->join('kategori_kebutuhan', 'kategori_kebutuhan.kategori_kebutuhan_id = kebutuhan.kategori_kebutuhan_id')->findAll();
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
            $kodekebutuhan = rand(1000000,9999999);
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
            }

            $q = $model->insert($data);
        }else{
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
            'status' => $req['status'],
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
}
