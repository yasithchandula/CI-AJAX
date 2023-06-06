<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use Config\Services;
use App\Model\Student;
use App\Controllers\FormValidation;
use App\Models\User;
use CodeIgniter\Commands\Utilities\Environment;
use CodeIgniter\Controller;
use CodeIgniter\Shield\Config\Auth;
use Firebase\JWT\JWT;



class LoginController extends BaseController{

    /**
     * - This function handles the user login of the system
     * - will initialize a session
     * @return view
     * 
     */

    public function login(){

        $username=$this->request->getPost('username');
        $password=$this->request->getPost('password');

        $user=new User();

        if($user->userlogin($username,$password)){

            session()->set('user',1);
            return redirect()->to(base_url('user_index'));

        }
        else{

            return redirect()->to(base_url('user_login'))->with('errors',['User not found']);

        }

                
    }

    
    /**
     * - Destroys the login session
     * @return view
     */

    public function logout(){

        session()->destroy();
        return redirect()->to(base_url('user_login'));


    }

    public function checkSession(){

        $isLoggedIn=(session('user')!=null);
        return $this->response->setJSON([
            'isLoggedIn'=>$isLoggedIn,
    
        ]);
    }
}


?>