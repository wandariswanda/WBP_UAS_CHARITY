<?php

namespace App\Controllers;
use App\Models\Auth_model;

class Auth extends BaseController
{
    protected $usernameSpec = [ 
        'username' => [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} tidak boleh kosong'
            ]
        ]
    ];

    protected $passSpec = [ 
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} tidak boleh kosong'
            ]
        ]
    ];

    public function __construct(){
        helper("util");
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
	}

    public function index()
    {
        $is_logged = $this->session->get('logged_in');
        if($is_logged){
            return redirect()->to('/dashboard');
        }

        $data = [
            "title" => "Masuk",
            "head_slider" => "",
            "content" => "auth/signin",
            "validation" => $this->validation
        ];

        return view("layout", $data);        
    }

    public function login(){
        // validaton post fields
        if(!$this->validate(
            array_merge($this->usernameSpec, $this->passSpec)
        )){
            $validation = $this->validation;
            return redirect()->to('/login')->withInput()->with('validation', $validation);
        }
        // End validation

        $post = $this->request->getPost();
        $AuthModel = new Auth_model;
        $arrUser = [ "username" => $post['username'] ];
        $getUser = $AuthModel->getUser($arrUser);

        if(!$getUser){
            session()->setFlashData("error", 'Username tidak ditemukan');
            return redirect()->to(base_url('/login'));
        }else{
            $password = hash('sha256', $post['password']);

            if($getUser['password'] != $password){
                session()->setFlashData("error", 'Password yang kamu masukan salah');
                return redirect()->to(base_url('/'));
            }else{
                $arrSessionUser = [
                    "user_id" => $getUser['user'],
                    'username' => $getUser['username'],
                    'role' => $getUser['role'],
                    'access_group_id' => $getUser['access_group_id'],
                ];

                $this->session->set(['logged_in' => TRUE]);
                $this->session->set("meta", $arrSessionUser);
                return redirect()->to(base_url('/dashboard'));
            }
        }
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to(base_url('/'));
    }
}
