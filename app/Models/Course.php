<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\MySQLi\Builder;

class Course extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = "course";
    protected $primaryKey       = "cID";
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'cID',
        'Department',
        'Course',
        'fee'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


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
