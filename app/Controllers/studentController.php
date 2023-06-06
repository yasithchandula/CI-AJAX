<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Student;

class studentController extends BaseController{

    /**
     * 
     * - @return Student view
     */

    public function index(){

        return view ('student/index');

    }

    /**
     * save student data to database
     */

    public function store(){

        $data=$this->request->getVar();

            $student=new Student();

            if($student->insertStd($data)){

                $data=['status'=>'Student Successfully Inserted'];
                return $this->response->setJSON($data);

            }
            else{

                return $this->response->setJSON(['error'=>'Student insertion unsuccessful']);

            }

    }

    /**
     * fetch all students
     */

    public function fetch(){

        $student=new Student();

        $students['student']=($student->fetchStudents());
        // print_r($student);

        // $students['student']=$student->findAll();

        return $this->response->setJSON($students);

    }

    /**
     * fetch student data for edit
     */
    public function edit(){

        $student=new Student();
        $sID=$this->request->getPost('sID');

        $data['student']=$student->editStudent($sID);

        return $this->response->setJSON($data);

    }


    /**
     * update student
     */
    public function update (){

        $student=new Student();
        $data=$this->request->getVar();
        $sID=$this->request->getVar('sID');

            $student=new Student();

            if($student->updateStudent($sID, $data)){

                $data=['status'=>'Student Successfully Updated'];
                return $this->response->setJSON($data);
            }
            else{

                return $this->response->setJSON(['error'=>'Student Update unsuccessful']);
            };


        // }



    }

    public function delete(){

        $student=new Student();
        $sID=$this->request->getPost('sID');
        $sIDx=implode(' ',[' ',$sID]);
        log_message('alert',$sIDx);

        if($student->delete($sID)){
            $student->delete($sID);
            return $this->response->setJSON(['status'=>'Student Successfully Deleted']);
        }
        else{
            return $this->response->setJSON(['error'=>'Student deletion unsuccessful']);
        }
        
        ;



    }






}


?>