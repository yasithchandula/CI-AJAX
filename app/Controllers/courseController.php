<?php

namespace App\Controllers;
use App\Model\Course;

class courseController extends BaseController{

    public function index(){
        return view('course/index.php');
    }



    /**
     * save course data to database
     */
    public function store(){

        $data=[
            'cID'=>$this->request->getPost('cID'),
            'Department'=>$this->request->getPost('department'),
            'Course'=>$this->request->getPost('course'),
            'fee'=>$this->request->getPost('fee'),

        ];

        $rules=[
            'cID'=>['required',],
            'Department'=>['required'],
            'Course'=>['required'],
            'fee'=>['required','decimal'],
        ];
        
        if (! $this->validateData($data, $rules)) {
            log_message('alert',implode(' ', [' ',$data['cID']]));

            return $this->response->setJSON(['error'=>'course insertion unsuccessful']);

        }else{
            $course=new Course();

            $x=$course->insert($data);
            if($x){
                $data=['status'=>'course Successfully Inserted'];
                return $this->response->setJSON($data);
            }
            else{
                return $this->response->setJSON($data);
            };


        }
    }

    /**
     * fetch all courses
     */

    public function fetch(){

        $course=new Course();
        $courses['course']=$course->findAll();
        return $this->response->setJSON($courses);

    }

    /**
     * fetch course data for edit
     */
    public function edit(){

        $course=new Course();
        $cID=$this->request->getPost('cID');
        $data['course']=$course->find($cID);
        return $this->response->setJSON($data);

    }


    /**
     * update course
     */
    public function update (){
        $course=new Course();

        $data=[
            'id'=>$this->request->getPost('id'),
            'cID'=>$this->request->getPost('cID'),
            'fee'=>$this->request->getPost('fee'),
            'Department'=>$this->request->getPost('department'),
            'Course'=>$this->request->getPost('course'),
        ];

        $rules=[
            'cID'=>['required','min_length[4]',],
            'fee'=>['required','decimal'],
            'Department'=>['required','min_length[2]','alpha_space'],
            'Course'=>['required','min_length[2]','alpha_space'],
        ];

        $id=$this->request->getPost('cID');


        if (! $this->validateData($data, $rules)) {

            return $this->response->setJSON(['error'=>'course Update unsuccessful']);

        }else{

            $course=new Course();
            $x=$course->update($id,$data);
            if($x){
                $data=['status'=>'Course Successfully Updated'];
                return $this->response->setJSON($data);
            }
            else{
                return $this->response->setJSON(['error'=>'course Update unsuccessful']);
            };


        }



    }

    public function delete(){
        $course=new Course();
        $cID=$this->request->getPost('cID');

        if($course->delete($cID)){
            $course->delete($cID);
            return $this->response->setJSON(['status'=>'course Successfully Deleted']);
        }
        else{
            return $this->response->setJSON(['error'=>'course deletion unsuccessful']);
        }
        
        ;



    }
}

?>
