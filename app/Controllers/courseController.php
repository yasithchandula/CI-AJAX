<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Course;

class courseController extends BaseController{

    public function index(){
        return view('course/index.php');
    }



    /**
     * save course data to database
     */
    public function store(){

        $coursedata=$this->request->getVar();


        $course=new Course();

        if($course->storeCourse($coursedata))
        {
            return $this->response->setJSON(['status'=>'course Successfully Inserted']);
        }
        else
        {
            return $this->response->setJSON(['status'=>'course insertion unsuccessfull']);
        };

    }

    /**
     * fetch all courses
     */

    public function fetch(){

        $course=new Course();
        $courses['course']=$course->findAll();
        log_message('alert',json_encode($courses));
        return $this->response->setJSON($courses);

    }

    /**
     * fetch course data for edit
     */
    public function edit(){
        $cID=$this->request->getPost('cID');

        $course=new Course();
        $data=$course->editCourse($cID);

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
