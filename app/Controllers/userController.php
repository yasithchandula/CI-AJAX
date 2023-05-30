<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\User;

use Config\Services;
use App\Model\Student;
use App\Controllers\FormValidation;
use CodeIgniter\Controller;
use Throwable;

class userController extends BaseController {

    /**
     * - This funtion controls the registration process of user
     */
    public function regView(){
        return view('user/register');
    }

    /**
     * -Save user to the system
     */

     public function saveUser(){
        $data=[
            'username'=>$this->request->getPost('username'),
            'email'=>$this->request->getPost('email'),
            'password'=>$this->request->getPost('password')
        ];
        //$password=$this->request->getPost('password');


            $user=new User();

            if($user->find($data['username'])){

                return redirect()->back()->with('errors', ['User already Exist on the system']);

            }else{
                $options=[
                    'cost'=>10
                ];

                /**
                 * - can't use return of getPost() in password_hash. Says parameter should be string
                 * - return of the getPost method recognized as an array
                 */
                
                $password = [' ',$this->request->getPost('password')];
                $pwstr= implode(' ',$password);

                $data['password']=password_hash($pwstr,PASSWORD_BCRYPT,$options);
                

                if($user->insert($data)){

                    // $x=$user->save($data);
                    return redirect()->to(base_url('user_login'))->with('message', $user);

                }else{

                    return redirect()->to(base_url('userreg'))->with('message', $data);
                }
               

            }

        
     }

     public function loginController (){
        return view('user/login');
     }

     public function userIndex(){
        return view('user/index');
     }

}