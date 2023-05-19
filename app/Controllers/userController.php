<?php

namespace App\Controllers;
use Config\Services;
use App\Model\Student;
use App\Controllers\FormValidation;
use App\Model\User;
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

        $rules=[
            'username'=>['required'],
            'email'=>['required','valid_email'],
            'password'=>['required'],
        ];

        if (! $this->validateData($data, $rules)) {

            return redirect()->back()->with('errors', $this->validator->getErrors());

        }else{

            $user=new User();

            if($user->find($data['username'])){

                return redirect()->back()->with('errors', ['User already Exist on the system']);

            }else{
                $options=[
                    'cost'=>10
                ];
                
                $password = [' ',$this->request->getPost('password')];
                $pwstr= implode(' ',$password);

                $data['password']=password_hash($pwstr,PASSWORD_BCRYPT,$options);
                

                if($user->insert($data)){

                    // $x=$user->save($data);
                    return redirect()->to(base_url('user_login'))->with('message', $user);

                }else{

                    return redirect()->to(base_url('student_add'))->with('message', $data);
                }
               

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