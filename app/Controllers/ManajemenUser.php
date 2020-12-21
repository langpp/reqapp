<?php namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UserModel;

class ManajemenUser extends BaseController
{
    public function index()
    {
        $model = new RoleModel();

        $data = ["role" => $model->findAll()];

        return view('pages/manajemen-user', $data);
    }

    function list() {
        $data = array();
        $req = $this->request->getVar();
        $no = $req['start'];

        $model = new UserModel();
        foreach ($model->select('user_id, nama_dinas, alamat_dinas, nomor_telepon, email, role')->getAll($req) as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_dinas;
            $row[] = $field->alamat_dinas;
            $row[] = $field->nomor_telepon;
            $row[] = $field->email;
            $row[] = $field->role;
            $row[] = '<button type="button" class="btn btn-info btn-xs edit" data-id="' . $field->user_id . '"><i class="fa fa-pencil-alt"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-xs delete" data-id="' . $field->user_id . '"><i class="fa fa-trash-alt"></i></button>';

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
        $model = new UserModel();

        $data = [
            'user_id' => $req['id'],
        ];

        $q = $model->select('user_id, nama_dinas, alamat_dinas, nomor_telepon, email, role_id')->getWhere($data)->getRow();

        return json_encode($q);
    }

    public function insert()
    {
        $req = $this->request->getVar();
        $model = new UserModel();

        $data = [
            'nama_dinas' => $req['nama_dinas'],
            'alamat_dinas' => $req['alamat_dinas'],
            'nomor_telepon' => $req['nomor_telepon'],
            'email' => $req['email'],
            'password' => password_hash($req['password'], PASSWORD_BCRYPT),
            'role_id' => $req['role_id'],
        ];

        $q = $model->insert($data);

        return json_encode($q);
    }

    public function edit()
    {
        $req = $this->request->getVar();
        $model = new UserModel();

        $data = [
            'nama_dinas' => $req['nama_dinas'],
            'alamat_dinas' => $req['alamat_dinas'],
            'nomor_telepon' => $req['nomor_telepon'],
            'email' => $req['email'],
            'role_id' => $req['role_id'],
        ];

        $q = $model->update($req['id'], $data);

        return json_encode($q);
    }

    public function delete()
    {
        $req = $this->request->getVar();
        $model = new UserModel();

        $q = $model->delete($req['id']);

        return json_encode($q);
    }
}
