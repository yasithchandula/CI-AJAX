<?php

namespace App\Model;

use CodeIgniter\Model;

class Student extends Model{

    protected $table = "student";
    protected $primaryKey="sID";
    protected $allowedFields = [
        'sID',
        'firstName', 
        'lastName', 
        'birthday', 
        'address', 
        'contactNumber', 
        'department', 
        'course'

    ];
}

?>