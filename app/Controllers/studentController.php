<?php
namespace App\Controllers;
use App\Model\Student;

class studentController extends BaseController{

    public function index(){

        return view ('student/index');

    }

    /**
     * save student data to database
     */
    public function store(){

        $data=[
            'firstName'=>$this->request->getPost('firstName'),
            'lastName'=>$this->request->getPost('lastName'),
            'birthday'=>$this->request->getPost('birthday'),
            'address'=>$this->request->getPost('address'),
            'contactNumber'=>$this->request->getPost('contactNumber'),
            'department'=>$this->request->getPost('department'),
            'course'=>$this->request->getPost('course'),
        ];

        $rules=[
            'firstName'=>['required','min_length[4]','alpha_space'],
            'lastName'=>['required','min_length[4]','alpha_space'],
            'birthday'=>['valid_date'],
            'address'=>'required',
            'contactNumber'=>['required','exact_length[10]','decimal'],
            'department'=>['required','min_length[2]','alpha_space'],
            'course'=>['required','min_length[2]','alpha_space'],
        ];
        log_message('alert',implode($data));
        
        if (! $this->validateData($data, $rules)) {

            return $this->response->setJSON(['error'=>'Student insertion unsuccessful']);

        }else{

            $student=new Student();
            if($student->insert($data)){
                $data=['status'=>'Student Successfully Inserted'];
                return $this->response->setJSON($data);
            }
            else{
                return $this->response->setJSON(['error'=>'Student insertion unsuccessful']);
            };


        }
    }

    /**
     * fetch all students
     */

    public function fetch(){

        $student=new Student();
        $students['student']=$student->findAll();
        return $this->response->setJSON($students);

    }

    /**
     * fetch student data for edit
     */
    public function edit(){

        $student=new Student();
        $sID=$this->request->getPost('sID');
        $data['student']=$student->find($sID);
        return $this->response->setJSON($data);

    }


    /**
     * update student
     */
    public function update (){
        $student=new Student();

        $data=[
            'firstName'=>$this->request->getPost('firstName'),
            'lastName'=>$this->request->getPost('lastName'),
            'birthday'=>$this->request->getPost('birthday'),
            'address'=>$this->request->getPost('address'),
            'contactNumber'=>$this->request->getPost('contactNumber'),
            'department'=>$this->request->getPost('department'),
            'course'=>$this->request->getPost('course'),
        ];

        $rules=[
            'firstName'=>['required','min_length[4]','alpha_space'],
            'lastName'=>['required','min_length[4]','alpha_space'],
            'birthday'=>['valid_date'],
            'address'=>'required',
            'contactNumber'=>['required','exact_length[10]','decimal'],
            'department'=>['required','min_length[2]','alpha_space'],
            'course'=>['required','min_length[2]','alpha_space'],
        ];

        $sID=$this->request->getPost('sID');


        if (! $this->validateData($data, $rules)) {

            return $this->response->setJSON(['error'=>'Student Update unsuccessful']);

        }else{

            $student=new Student();
            if($student->update($sID,$data)){
                $data=['status'=>'Student Successfully Updated'];
                return $this->response->setJSON($data);
            }
            else{
                return $this->response->setJSON(['error'=>'Student Update unsuccessful']);
            };


        }



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