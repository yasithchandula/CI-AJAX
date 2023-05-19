<?php

namespace App\Model;

use CodeIgniter\Model;

class Course extends Model{

    protected $table = "course";
    protected $primaryKey="cID";
    protected $allowedFields = [
        'cID',
        'Department',
        'Course',
        'fee'
    ];
}

?>