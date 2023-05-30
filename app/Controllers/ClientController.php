<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Model\Student;

class ClientController extends BaseController
{
    public function index()
    {
        return view('client/login');
    }

    public function logger()
    {
        $username=$this->request->getVar('username');
        $password=$this->request->getVAr('password');

        $student = new Student();
        
        if($student->logger($username,$password)){

            session()->set('user',1);
            session()->set('username',$username);
            return redirect()->to(base_url('client/index'));

        }
        else{

            return redirect()->to(base_url('clientlogin'))->with('errors',['User not found']);

        }
    }

    public function indexView()
    {
        return view ('client/index');
    }
}
