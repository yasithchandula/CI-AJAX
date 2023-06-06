<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Validation\Exceptions\ValidationException;
use Config\Services;
use CodeIgniter\HTTP\Response;

class StudentFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $validation=Services::validation();
        $response=Services::response();
        
        $rules=[
            'firstName'=>['required','min_length[4]','alpha_space'],
            'lastName'=>['required','min_length[4]','alpha_space'],
            'birthday'=>['valid_date'],
            'email'=>['required'],
            'address'=>'required',
            'city'=>'required',
            'contactNumber'=>['required','exact_length[10]','decimal'],
            'department'=>['required','min_length[2]','alpha_space'],
            'course'=>['required','min_length[2]','alpha_space'],
        ];

        if(!($validation->setRules($rules,getVar()))){

            return $response->setJSON(['error'=>'Student Update unsuccessful']);

        }


        
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
