<?php

namespace App\Model;

use CodeIgniter\Model;

class User extends Model{

    protected $table = "user";
    protected $primaryKey="username";
    protected $allowedFields = [
       'username',
       'email',
       'password',
    ];


    public function userlogin ($username,$password){

        $builder=$this->db->table('user');
        $builder->select('*')->where('username',$username);
        $qeryR=$builder->get();
        $user=$qeryR->getRow();

        /**
         * - In registration can't use return of getPost() in password_hash. Says parameter should be string
         * - return of the getPost method recognized as an array.
         * - So, had to use implode for the inputed password as well, if not, password_verify always returns false
         */

        $pwstr = implode(' ', [' ',$password]);


        if (isset($user)){

            if(password_verify($pwstr,$user->password)){

                return $user;
            }
            else{

                return false;
            }

        }



    }


    public function userRegister(){




        
    }

}

?>