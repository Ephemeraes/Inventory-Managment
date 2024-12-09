<?php namespace App\Controllers;

use CodeIgniter\Controller;

class ProjectController extends BaseController
{
    public function __construct()
    {
        helper('url'); 
        $this->session = session();
    }
    
    //Reference: https://codeigniter.org/userguide3/libraries/sessions.html#flashdata
    public function index()
    {
        $data['name'] = 'Log in';
        $data['message'] = $this->session->getFlashdata();
        return view('login', $data);
    }

    //Reference: https://chat.openai.com/share/e44bade5-434a-4b1a-9387-5c76160f021f
    public function login()
    {
        $session = session();
        $accountModel = new \App\Models\AccountModel();
        $employeeModel = new \App\Models\EmployeeModel();
        $id = $this->request->getPost('id');
        $password = $this->request->getPost('password');
        if ($accountModel->verifyUser($id, $password)) {
            $employee = $employeeModel->where('id', $id)->first();
            $session->set('isLoggedIn', true);
            session()->set('id', $id);
            session()->set('role', $employee['role']);
            if ($employee['role'] == 'manager') {
                return redirect()->to('/operation');
            }
            return redirect()->to('/inventory');
        } else {
            session()->setFlashData('error', 'Wrong password or Invalid user.');
            return redirect()->to('/');
        }
    }

    public function logout() {
        session()->destroy();
        return redirect() -> to('/');
    }

    public function template() {
        $data['name'] = 'Sort Data';
        return view('template', $data);
    }
}