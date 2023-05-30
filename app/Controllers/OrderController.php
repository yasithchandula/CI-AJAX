<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;


class OrderController extends BaseController
{

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
     * - Return to index view of order
     */

    public function index(){

        return view ('order/index');

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




    
}