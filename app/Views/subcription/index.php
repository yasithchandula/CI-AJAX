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


<!--Carging api-->
                <div class="modal fade prePayment" id="prePayment" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Update course</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="hidden_pre_pay">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger toPrePaybtn" > Confirm Payment </button>
                        </div>
                    </div>
                    </div>
                </div>

<!--Carging completed-->
<div class="modal fade chargingcompleted" id="chargingcompleted" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Payment Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="cg_para">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger toPrePaybtn" > Confirm Payment </button>
                        </div>
                    </div>
                    </div>
                </div>

<!--findOrder-->
<div class="modal fade findOrder" id="findOrder" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Find Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label>Enter Order ID to get payment details </label>
                            <input type="text" class="form-control" id="f_orderid" placeholder="Enter Order ID">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger f_orderbtn" > Find Order Details </button>
                        </div>
                    </div>
                    </div>
                </div>



                <!--Payment Details-->
                <div class="modal fade paymentDetails" id="paymentDetails" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Payment Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="py_details">

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
                    $each(response.data,function(key,val){
                        console.log(key,val);
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


