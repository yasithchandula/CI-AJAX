<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Student;
use CodeIgniter\Database\MySQLi\Builder;

use CodeIgniter\Model;
use Exception;

class Order extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'order_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'order_id',
        'sID',
        'order_title',
        'email',
        'status',
        'recurring',
        'message_type',
        'item_recurrence',
        'item_duration',
        'item_rec_status',
        'item_rec_date_next',
        'item_rec_install_paid',
        'customer_token',
        'status_message',
        'amount',




    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    /**
     * - Generates order ID
     */

    public function orderIdGen (){

        try{

            $query = $this->db->query("SELECT MAX(order_id) AS max_order_id FROM orders");
            $result = $query->getRow();
    
            $maxOrderId = $result->max_order_id;
            $nextOrderId = $maxOrderId ? intval($maxOrderId) + 1 : 1;
    
            return $nextOrderId;
            

        } catch(\Exception $e){

            log_message('alert', $e->getMessage());
            throw new \Exception("An error occurred while inserting the Order.");

        }
        
    }


    /**
     * Save order details to teh databae and return order details with hash
     */
    

    public function clientOrder ($data){


        $orderID=$this->orderIdGen();
        $merchant_id='1223220';
        $currency='LKR';
        $merchant_secret=getenv('M_SECRET');

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $orderID . 
                number_format(floatval($data['fee']), 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

        $toDB=[
            'order_id'=>$orderID,
            'cID'=>$data['cID'],
            'sID'=>$data['sID'],
            'order_title'=>$data['course'],
            'fee'=>$data['fee'],
            'email'=>$data['email'],
            'status'=>'0',
            
        ];


        $toPayhere=[
            'merchant_id'=>$merchant_id,
            'return_url'=>'https://ci4ajax.herokuapp.com/client/index',
            'cancel_url'=>'https://ci4ajax.herokuapp.com/client/order_cancel',
            'notify_url'=>'https://ci4ajax.herokuapp.com/client/verifyOrder',
            'first_name'=>$data['firstName'],
            'last_name'=>$data['lastName'],
            'email'=>$data['email'],
            'phone'=>$data['contactNumber'],
            'address'=>intval($data['address']),
            'city'=>$data['city'],
            'country'=>'Sri Lanka',
            'order_id'=>$orderID,
            'items'=>$data['course'],
            'currency'=>$currency,
            'amount'=>$data['fee'],
            'hash'=>$hash,
            ];
        
        $builder=$this->db->table('orders');

        if($builder->insert($toDB)){

            return $toPayhere;
        }
        else
        {
            return false;
        };


    }


    /**
     * - verify the order and update the order status
     */

    public function verifyOrderByHash($data){

        $merchant_secret=getenv('M_SECRET');

        $builder = $this->db->table('orders');
        
        // $local_hash = $builder->select('hash')->where('order_id'==$data['order_id'])->get()->getResult();

        $local_md5sig = strtoupper(
            md5(
                $data['merchant_id'] . 
                $data ['order_id'] . 
                $data ['payhere_amount'] . 
                $data ['payhere_currency'] . 
                $data ['status_code'] . 
                strtoupper(md5($merchant_secret)) 
            ) 
        );
        

        if(($local_md5sig==$data['md5sig']) AND ($data['status_code']==2)){



            try
            {
                

                if(array_key_exists('item_recurrence',$data)){

                    $dbData=[
                        'status'=>$data['status_code'],
                        'recurring'=>$data['recurring'],
                        'message_type'=>$data['message_type'],
                        'item_recurrence'=>$data['item_recurrence'],
                        'item_duration'=>$data['item_duration'],
                        'item_rec_status'=>$data['item_rec_status'],
                        'item_rec_date_next'=>$data['item_rec_date_next'],
                        'item_rec_install_paid'=>$data['item_rec_install_paid'],
                        'status_message '=>$data['status_message'],
                        'amount'=>$data['payhere_amount'],
                    ];

                    log_message("alert",json_encode($data));
                    $builder->where('order_id',$data['order_id'])->update($dbData);
                    return true;
                }
                else if (array_key_exists('customer_token',$data)){

                    $dbData=[
                        'status'=>$data['status_code'],
                        'customer_token'=>$data['customer_token'],
                        'status_message'=>$data['status_message'],
                        'amount'=>$data['payhere_amount'],
                    ];

                    log_message("alert",json_encode($data));
                    $builder->where('order_id',$data['order_id'])->update($dbData);


                }
                else{

                    $dbData=[
                        'status'=>$data['status_code'],
                        'status_message'=>$data['status_message'],
                        'amount'=>$data['payhere_amount'],
                    ];

                    log_message("alert",json_encode($data));
                    $builder->where('order_id',$data['order_id'])->update($dbData);
                }


            }
            catch (\Exception $e){

                log_message('alert',$e->getMessage());
                throw new Exception("An error occured while updating the status of the order");

            }


        }


    }


    public function clickPayBtn ($sID,$cID){

        $student=new Student();
        $course=new Course();

        $data['course']=(array)$course->editCourse($cID);
        $data['student']=(array)$student->stdPay($sID);
        

        return array_merge( $data['course'],$data['student']);



        


        // return $data;


    }


    public function returnOrderDetails($data){

        

        $builder=$this->db->table('orders');

        $builder->where('order_id'==$data['order_id'])->update($data);

        
    }

    /**
     * get all the pre approved order list
     * 
     */


    public function getPreAppOrders(){

        $builder=$this->db->table('orders');

        $data = $builder->select('order_id,sID,order_title,status_message,amount')->where('customer_token IS NOT NULL AND LENGTH(customer_token)>0',NULL,false)->get()->getResult();

        
        // log_message('alert','preapproved');
        // log_message('alert',json_encode($data));

        return ($data);

    

    }



    public function toPayhereChargin($order_id){

        log_message('alert',$order_id);

        $builder=$this->db->table('orders');

        $data=(array)$builder->select('order_id,order_title,amount,customer_token')
        ->where('order_id',$order_id)->get()->getRow();

        $data['Authorization']=getenv('ACCESS_TOKEN');

        log_message('alert',json_encode($data));


        return $data;
    }




}
