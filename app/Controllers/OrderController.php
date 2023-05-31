<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;
use CodeIgniter\HTTP\CURLRequest;
use Config\Services;

class OrderController extends BaseController
{
    public function index()
    {
        return view('order/index.php');
    }

     /**
     * - Get client data from the post request and return the data with hash as json
     */
    public function clientPay()
    {
        $data=$this->request->getVar();
        
        $order=new Order();

        $toPayhere=$order->clientOrder($data);

        if($toPayhere)
        {

            return $this->response->setJSON($toPayhere);

        }
        else
        {
            return redirect()->to(base_url('client/index'));


        }

        
    }


    /**
     * - verify the payment and update the databas
     * 
     */


    public function verifyOrder(){

        $data=$this->request->getPost();

        log_message('alert','notify url');
        log_message('alert',json_encode($data));

        $order=new Order();

        if($order->verifyOrderByHash($data)){

            return redirect()->to(base_url('client/index'));

        }else{
            return redirect()->to(base_url('clientlogin'));
        };


    }


    public function payClick (){

        $cID=$this->request->getPost('cID');
        $sID=session()->get('username');

        $order=new Order();

        if($data=$order->clickPayBtn($sID,$cID)){

            // log_message('alert', json_encode($data));
            return $this->response->setJSON($data);

        }else{

            return $this->response->setJSON('error','error');
        }



    }


    public function returnOrder(){

        $data= $this->request->getVar();
        log_message('alert','return url');
        log_message('alert',json_encode($data));

        $order=new Order();

        $order->returnOrderDetails($data);

        return redirect()->to(base_url('client/index'));
    }




    public function fetchPreOrders(){

        $order=new Order();

        $p_order['order']=(array)($order->getPreAppOrders());

        log_message('alert',json_encode($p_order));

        return $this->response->setJSON($p_order);
    }


        /**
     * - Get order id from body and return the charging api needs
     */

     public function payhereCharging() {

        $order_id = $this->request->getVar('order_id');

        $order = new Order();

        log_message('alert',json_encode($order->toPayhereChargin($order_id)));

        return $this->response->setJSON($order->toPayhereChargin($order_id));




    }

    public function accessTokenGen(){
        $auth_code=getenv('AUTH_CODE');
        $url='https://eokwyobr35ggdi5.m.pipedream.net';

        $options=[
            'headers'=>['Authorization'=>'Basic ' .$auth_code],

            'body'=>json_encode(['grant_type'=>'client_credentials'])
        ];

        // log_message('alert',json_encode($options));
        $curl=Services::curlrequest();


        $response = ($curl->request('POST',$url,$options));
        
        return $response;


    }


    public function toChargingAPI(){

        // $data = $this->request->getVar();
        // $access_t="75e0ac0b-1067-4fb4-ae57-2cc0ada30ccc";

        // $auth = 'Bearer ' .$access_t;
        // $url = 'https://sandbox.payhere.lk/merchant/v1/payment/charge';
        // print_r($url);

        // $options = [
        //     'headers'=>['Authorization'=>$auth,
        //                 'Content-Type'=> 'application/json'], // Set the request headers
        //     'body'=>json_encode($data),
        // ];
        
        // // Send the request
        // $curl=Services::curlrequest();

        // $res = ($curl->request('POST',$url,$options));

        return $this->accessTokenGen();
        



        
    }


    
}

