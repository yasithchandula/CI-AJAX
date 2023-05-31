<?= $this->extend('layouts/frontend.php')?>

<?=$this->section('content') ?>
    <div class="container">
    <h2 style="text-align: center;">Order Management</h2>
    <br>
        <div class="row">
            
            <div class="col md-12">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">

            <table class="table table-bordered">
            <caption>List of Orders</caption>
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Order Title</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    
                </tr>
            </thead>
            <tbody class="orderdata">
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


                    <?=$this->endSection()?>

<?=$this->section('scripts') ?>


    
    <script>
        /**
         * - Load preapproved orders from db
         */

        $(document).ready(function(){
            preapprovedOrders();
        });


        /**
         * - Listning to click on edit button
         * - Load the Course edit modal and pass the parameters to input fields on the modal
         */
        $(document).on('click','.get-payment',function(){
            var order_id = $(this).closest('tr').find('.order_id').text();
            console.log(order_id);
            $.ajax({
                method:"POST",
                url:"payhere_charging",
                data : {
                    "order_id":order_id
                },
                success:function(response){
                    // console.log(response);
                    $.each(response,function(key,value){
                        console.log(key,value);
                        $('.hidden_pre_pay').append('\
                        <input type="hidden" name="'+key+'" id="pr_'+key+'" value='+value+'>');
                        $('.prePayment').modal('show')
                    })

                    }
            })

        })

        /**
         * - update the course details
         * - Sends the values stored in input fields of the model
         */

        $(document).on('click','.toPrePaybtn',function(){

                    var data ={
                        "type": "PAYMENT",
                        "order_id": $('#pr_order_id').val(),
                        "items": 'Course Fee',
                        "currency": "LKR",
                        "amount": $('#pr_amount').val(),
                        "customer_token": $('#pr_customer_token').val(),
                        "custom_1": null,
                        "custom_2": null,
                        "notify_url": "",
                        "itemList":[$('#pr_order_title').val()],
                    }

                    var auth= 'Bearer '+$('#pr_Authorization').val();
                    console.log(auth);
                    console.log(data);

                    $.ajax({
                        method:"POST",
                        url:"https://sandbox.payhere.lk/merchant/v1/payment/charge",
                        headers:{
                            'Authorization':auth,
                            'Content-Type': 'application/json'
                        },
                        data:[{'grant_type': 'client_credentials'}],
                        success:function(response){
                            $('#courseModal').modal('hide');
                            $('#courseModal').find('input').val('');
                                    if(response.status){
                                        console.log(response);
                                    }
                                    else{
                                        alertify.error(response.error);
                                    }
                        }
                    })
            

        })


    /**
     * Load all the course records from the database
     */

        function preapprovedOrders(){
            $.ajax({
                method:"GET",
                url:"preorders",
                success:function(response){
                    console.log(response.order);
                    $.each(response.order,function(key,value){
                        console.log(key,value);
                        $('.orderdata').append('<tr>\
                        <td class="order_id">'+value['order_id']+'</td>\
                        <td>'+value['sID']+'</td>\
                        <td>'+value['order_title']+'</td>\
                        <td>'+value['amount']+'</td>\
                        <td>'+value['status_message']+'</td>\
                        <td> <a href="#" class="badge btn btn-primary get-payment">Get Payment</a>\
                        </td>\
                        </tr>');
                        
                    })
                }
            })
        }


    </script>


<?=$this->endSection()?>


