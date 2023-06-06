<?php

namespace App\Model;

use CodeIgniter\Database\MySQLi\Builder;
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


    public function storeCourse ($course){

            $data=[
            'cID'=>$course['cID'],
            'Department'=>$course['department'],
            'Course'=>$course['course'],
            'fee'=>$course['fee'],

        ];

        try{

            $builder=$this->db->table('course');
            return ($builder->insert($data));
            

        } catch(\Exception $e){

            log_message('error', $e->getMessage());
            throw new \Exception("An error occurred while inserting the student.");

        }



    }


    public function editCourse($cID)
    {
        try
        {
            $builder=$this->db->table('course'); 
            return $builder->select('*')->where('cID',$cID)->get()->getFirstRow();

        }
        catch (\Exception $e)
        {
            log_message('alert', $e->getMessage());
            throw new \Exception("An error occured while searching the data");
        }
        
    }

}

?>