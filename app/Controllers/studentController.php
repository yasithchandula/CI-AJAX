<?php
namespace App\Controllers;
use App\Model\Student;

class studentController extends BaseController{

    public function index(){

        return view ('student/index');

    }

}


?>