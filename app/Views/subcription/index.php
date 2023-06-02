<?= $this->extend('layouts/frontend.php')?>

<?=$this->section('content') ?>
    <div class="container">
    <h2 style="text-align: center;">Subscription Management</h2>
    <br>
        <div class="row">
            
            <div class="col md-12">

                <div class="card">

                    <div class="card-body">

            <table class="table table-bordered">
            <caption>List of Orders</caption>
            <thead>
                <tr>
                    <th scope="col">Subcription ID</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Recurring</th>
                    <th scope='col'>Status</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Actions</th>
                    
                </tr>
            </thead>
            <tbody class="subcriptionData">
            </tbody>
            </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



                <!--Subscription Details-->
                <div class="modal fade subscriptionDetails" id="subscriptionDetails" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Subscription Details For Subscription ID : <label id="sub_order_id"></label></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <table class="table table-bordered">
                                <caption>List of Orders</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">PaymentID</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="payment_d_table">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>


                <!--Retry Payment-->
                <div class="modal fade retrySubPayment" id="retrySubPayment" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Subscription Retry Result: <label id="sub_order_id"></label></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="retryResponse">

                            </div>
                        </div>
                    </div>
                    </div>
                </div>



                <!--Cancel Subscription-->
                <div class="modal fade cancelSubModal" id="cancelSubModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Subscription Status <label id="sub_order_id"></label></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="cancelResponse">

                            </div>
                        </div>
                    </div>
                    </div>
                </div>




<?=$this->endSection()?>

<?=$this->section('scripts') ?>


    
    <script>
        /**
         * - Load preapproved orders from db
         */

        $(document).ready(function(){
            getAllSubcriptions();
        });


        /**
         * - Listning to click on edit button
         * - Load the Course edit modal and pass the parameters to input fields on the modal
         */
        // $(document).on('click','.get-payment',function(){
        //     var order_id = $(this).closest('tr').find('.order_id').text();
        //     console.log(order_id);
        //     $.ajax({
        //         method:"POST",
        //         url:"payhere_charging",
        //         data : {
        //             "order_id":order_id
        //         },
        //         success:function(response){

        //             $.each(response,function(key,value){
        //                 console.log(key,value);
        //                 $('.hidden_pre_pay').append('\
        //                 <input type="hidden" name="'+key+'" id="pr_'+key+'" value='+value+'>');
        //                 $('.prePayment').modal('show')
        //             })

        //             }
        //     })

        // })

        /**
         * - Preapproval Authorization
         */

        // $(document).on('click','.toPrePaybtn',function(){

        //             var data ={
        //                 "type": "PAYMENT",
        //                 "order_id": $('#pr_order_id').val(),
        //                 "items": 'Course Fee',
        //                 "currency": "LKR",
        //                 "amount": $('#pr_amount').val(),
        //                 "customer_token": $('#pr_customer_token').val(),
        //                 "custom_1": 'ddd',
        //                 "custom_2": 'sss',
        //                 "notify_url":"https://ci4ajax.herokuapp.com/client/verifyOrder",
        //                 "itemList":[''],
        //                                     }
        //             // console.log(data);
                
        //             $.ajax({
        //                 method:"POST",
        //                 url:"tochargingapi",
        //                 data:data,
        //                 success:function(response){

        //                     $('#cg_para').append(
        //                         '<p>'+response.status+'</p>'
        //                     );

        //                     $('#prePayment').modal('hide');
        //                     $('#chargingcompleted').modal('show');

        //                     console.log(response);


        //                 }
        //             })
            

        // })





    /**
     * Load all the course records from the database
     */

        function getAllSubcriptions(){
            $.ajax({
                method:"GET",
                url:"getallsub",
                success:function(response){
                    var data=JSON.parse(response);
                    // console.log(data.data);
                    $.each(data.data,function(key,value){
                        $('.subcriptionData').append('<tr>\
                        <td class="subscription_id">'+(value.subscription_id)+'</td>\
                        <td>'+(value.order_id)+'</td>\
                        <td>'+(value.date)+'</td>\
                        <td>'+(value.description)+'</td>\
                        <td>'+(value.recurring)+'</td>\
                        <td>'+(value.status)+'</td>\
                        <td>'+(value.amount)+'</td>\
                        <td> <a href="#" class="badge btn btn-success sub_pay_view">View Payment Details</a><br>\
                        <a href="#" class="badge btn btn-primary sub_pay_retry">Retry Payment</a><br>\
                        <a href="#" class="badge btn btn-danger sub_pay_cancel">Cancel Subscription</a>\
                        </td>\
                        </tr>');
                        
                    })


                    // $.each(response.order,function(key,value){
                    //     console.log(key,value);
                    //     $('.orderdata').append('<tr>\
                    //     <td class="order_id">'+value['order_id']+'</td>\
                    //     <td>'+value['sID']+'</td>\
                    //     <td>'+value['order_title']+'</td>\
                    //     <td>'+value['amount']+'</td>\
                    //     <td>'+value['status_message']+'</td>\
                    //     <td> <a href="#" class="badge btn btn-primary get-payment">Get Payment</a>\
                    //     </td>\
                    //     </tr>');
                        
                    // })
                }
            })
        }

        $(document).on('click','.sub_pay_view',function(){
            var sub_id={
                'subscription_id':$(this).closest('tr').find('.subscription_id').text()
            }
            console.log(sub_id);

            $.ajax({
                method:"POST",
                url:"findSubscription",
                data:(sub_id),
                success:function(response){
                    var data=JSON.parse(response);
                    console.log(data);
                    $.each(data.data,function(key,value){
                        $('.payment_d_table').append('<tr>\
                        <td class="subscription_id">'+(value.payment_id)+'</td>\
                        <td>'+(value.date)+'</td>\
                        <td>'+(value.amount)+'</td>\
                        <td>'+(value.description)+'</td>\
                        <td>'+(value.status)+'</td>\
                        </tr>');
                        
                    })

                    $('#sub_order_id').append(sub_id.subscription_id).text();

                    $('.subscriptionDetails').modal('show');

                }

            })
                

        })

        $('.subscriptionDetails').on('hidden.bs.modal', function(){
                $(".payment_d_table").html('');
                $('#sub_order_id').html('');
        });

        $(document).on('click','.sub_pay_retry',function(){
            var sub_id={
               'subscription_id':$(this).closest('tr').find('.subscription_id').text()
            }
            
            $.ajax({
                method:"POST",
                url:'retrysub',
                data:sub_id,
                success:function(response){
                    var data=JSON.parse(response);
                    console.log(data.msg);

                    $('.retryResponse').append(data.msg);

                }
            })

            $('.retrySubPayment').modal('show');
        })

        $('.retrySubPayment').on('hidden.bs.modal', function(){
                $(".retryResponse").html('');
        });



        $(document).on('click','.sub_pay_cancel',function(){
            var sub_id={
               'subscription_id':$(this).closest('tr').find('.subscription_id').text()
            };

            $.ajax({
                method:"POST",
                url:'cancelSub',
                data:sub_id,
                success:function(response){
                    var data=JSON.parse(response);
                    console.log(data.msg);

                    $('.cancelResponse').append(data.msg);

                }
            })

            $('.cancelSubModal').modal('show');

        })

        
        
        


        // $(document).on('click','#nav_findorder',function(){
        //     $('.findOrder').modal('show');
        // })



        // $(document).on('click','.f_orderbtn',function(){

        //     var data={'order_id':$('#f_orderid').val()};
            
        //     console.log(data);

        //     $.ajax({
        //         method:"POST",
        //         url:"orders/findorder",
        //         data:data,
        //         success:function(response){
        //             console.log(response);
        //             $('.findOrder').modal('hide');

        //             $('#py_details').append('<p>'+response+'</p>');


        //             $('.paymentDetails').modal('show');

        //         }
        //     })


        // })




        


    </script>


<?=$this->endSection()?>


