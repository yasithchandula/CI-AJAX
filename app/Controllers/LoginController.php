<?php

namespace App\Controllers;
use Config\Services;
use App\Model\Student;
use App\Controllers\FormValidation;
use App\Model\User;
use CodeIgniter\Commands\Utilities\Environment;
use CodeIgniter\Controller;
use CodeIgniter\Shield\Config\Auth;
use Firebase\JWT\JWT;



class LoginController extends BaseController{

    /**
     * - This function handles the user login of the system
     * - will initialize a session
     * @return view
     */

    public function login(){

        // var_dump($this->request->getPost());

        $data=[
            'username'=>$this->request->getPost('username'),
            'password'=>$this->request->getPost('password')
        ];

        print_r($this->request->getPost('username'));
       

        var_dump($data);

        $pwstr = implode(' ', [' ',$data['password']]);
        

        $user=new User();


        if (!($user=$user->find($data['username']))){
            
            return redirect()->to(base_url('user_login'))->with('errors',['User not found']);

        }else{

            if(password_verify($pwstr,$user['password'])){

                session()->set('user',1);
    
                return redirect()->to(base_url('user_index'));

                // /** @var JWTManager $manager */
                // $manager = service('jwtmanager');
        
                // // Generate JWT and return to client
                // $jwt = $manager->generateToken($user);
                // var_dump($jwt);
        
                // return $this->response->setJSON([
                //     'access_token' => $jwt,
                // ]);

            }else{

                return redirect()->to(base_url('user_login'))->with('errors',['Incorrect Password']);

            }

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