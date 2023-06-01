<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;
use CodeIgniter\HTTP\CURLRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use stdClass;

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
    /**
     * - Generate Access Token for the ocharging request
     * 
     */

    public function accessTokenGen(){
        $auth_code='Basic '.getenv('AUTH_CODE');
        $url='https://sandbox.payhere.lk/merchant/v1/oauth/token';

        $body = http_build_query(array('grant_type'=>'client_credentials'));

        $curl=Services::curlrequest();
        $curl->setHeader('Authorization',$auth_code);
        $curl->setBody($body);

        $response= new stdClass();

        $response = ($curl->request('POST',$url))->getBody();
        $data=json_decode($response,true);


        return $data['access_token'];

    }


    public function toChargingAPI(){

        $data = ($this->request->getVar());

        $data['notify_url']='https://ci4ajax.herokuapp.com/client/verifyOrder';

        $url='https://eokwyobr35ggdi5.m.pipedream.net';
       
        log_message('alert',json_encode($data));
        $access_t=$this->accessTokenGen();
        $auth = 'Bearer ' .$access_t;
        $body=http_build_query(array('type'=>$data['type'],'order_id'=>$data['order_id'],'items'=>$data['items'],'currency'=>$data['currency'],
        'customer_token'=>$data['customer_token'],'custom_1'=>$data['custom_1'],'custom_2'=>$data['custom_2'],'notify_url'=>$data['notify_url'],'itemList'=>$data['itemList']));

        $curl=Services::curlrequest();
        $curl->setHeader('Authorization',$auth);
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setBody($body);

        $response= new stdClass();
        $response = ($curl->request('POST',$url))->getBody();

        $data=json_decode($response,true);
        return $data;


        // $url = 'https://sandbox.payhere.lk/merchant/v1/payment/charge';

        // $options = [
        //     'headers'=>['Authorization'=>$auth,
        //                 'Content-Type'=> 'application/json'], // Set the request headers
        //     'body'=>json_encode($data),
        // ];
        
        // // Send the request
        // $curl=Services::curlrequest();

        // $res = ($curl->request('POST',$url,$options));

        // return $this->accessTokenGen();
        

        
    }


    
}

