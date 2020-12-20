<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function authCheck()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);

            if ($verify_pass) {
                $ses_data = [
                    'user_id' => $data['user_id'],
                    'email' => $data['email'],
                    'nama_dinas' => $data['nama_dinas'],
                    'role_id' => (int) $data['role_id'],
                    'logged_in' => true,
                ];

                $session->set($ses_data);

                if ($data['role_id'] == 2) {
                    return redirect()->to('/');
                }

                if ($data['role_id'] == 3) {
                    return redirect()->to('/pos');
                }
            } else {
                $session->setFlashdata('msg', 'E-mail atau password salah!');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'E-mail tidak terdaftar!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');

    }
    //--------------------------------------------------------------------

}
