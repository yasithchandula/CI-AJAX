<?php

namespace App\Models;

use CodeIgniter\Model;

class Student extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = "student";
    protected $primaryKey       ="sID";
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'sID',
        'firstName', 
        'lastName', 
        'birthday',
        'email', 
        'address',
        'city', 
        'contactNumber', 
        'department', 
        'course',
        'password'

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


      /**
     * - This function will insert student data record to the student table
     * @param array student array
     * @return bool
     */


     public function insertStd($data){

        $student=[
            'firstName'=>$data['firstName'],
            'lastName'=>$data['lastName'],
            'birthday'=>$data['birthday'],
            'email'=>$data['email'],
            'address'=>$data['address'],
            'city'=>$data['city'],
            'contactNumber'=>$data['contactNumber'],
            'department'=>$data['department'],
            'course'=>$data['course'],
        ];


        try{

            $builder=$this->db->table('student');
            return ($builder->insert($student));
            

        } catch(\Exception $e){

            log_message('error', $e->getMessage());
            throw new \Exception("An error occurred while inserting the student.");

        }

 

    }


    /**
     * This funtion fetch all the student records from the database
     */

    public function fetchStudents(){

        try{
            
            $builder = $this->db->table('student');
            $builder->select('*');
            $students = $builder->get()->getResult();

            log_message('alert', print_r($students, true));



            return $students;

        }
        catch(\Exception $e){

            log_message('error', $e->getMessage());
            throw new \Exception("An error occurred while fetching the student data");

        }




    }

    /**
     * - This function will retrive student data for payhere
     */
    public function stdPay($sID){
        $builder = $this->db->table('student');
        $student=$builder->select('firstName,lastName,contactNumber,address,email,city')->
        where('sID',$sID)->get()->getFirstRow();
        return $student;


    }


    /**
     * - This function will find and return a given student based on sID
     * @param int - Student ID
     * @return array|bool - Retuns student array or false
     */

    public function editStudent($sID){

        try{

            $builder=$this->db->table('student');
            $builder->select('*')->where('sID',$sID);
            $user=$builder->get()->getRow();
    
            if($user){
                
                return $user;
    
            }
            else{
    
                return false;
    
            }

        }catch(\Exception $e){
            log_message('error',$e->getMessage());
            throw new \Exception("Error occured during fetching student data");
        }

    }


    /**
     * - This function will update the student data
     */

     public function updateStudent($sID,$data){

        

        try{

            $student=[
                'firstName'=>$data['firstName'],
                'lastName'=>$data['lastName'],
                'birthday'=>$data['birthday'],
                'email'=>$data['email'],
                'address'=>$data['address'],
                'city'=>$$data['city'],
                'contactNumber'=>$data['contactNumber'],
                'department'=>$data['department'],
                'course'=>$data['course'],
            ];

            log_message('alert',json_encode($data));

            
    
            $builder=$this->db->table('student');
            $builder->where("sID",$sID);
            return $builder->update($student);

        }catch(\Exception $e){
            log_message('alert',json_encode($data));

            log_message('error',$e->getMessage());
            throw new \Exception("Error occured while updating the student");

        }


     }

     /**
      * - student login 
      */

      public function logger($username,$password){

        $builder=$this->db->table('student');
        $builder->select('*')->where('sID',$username);
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


}
