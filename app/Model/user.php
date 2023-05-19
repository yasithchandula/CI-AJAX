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

}

?>