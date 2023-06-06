<?= $this->extend('layouts/frontend.php')?>

<?=$this->section('content') ?>
    <div class="container">
    <h2 style="text-align: center;">Authorized Orders</h2>
    <br>
        <div class="row">
            
            <div class="col md-12">

                <div class="card">

                    <div class="card-body">

            <table class="table table-bordered">
            <caption>List of Orders</caption>
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Order Title</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Capture</th>
                    
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


                <!--Capture api-->
                <div class="modal fade capturePayment" id="capturePayment" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Capture Payment</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="hidden_capture">

                            </div>
                            <label><h5 style="color:firebrick">Enter below details to continue</h5><br></label>

                            <label>Enter Amount Do you want to capture</label>
                            <input type="text" class="form-control" id="c_amount" placeholder="Enter amount">

                            <label>Enter Reason for capture </label>
                            <input type="text" class="form-control" id="c_reason" placeholder="Enter Reason for capture">
                            <br>
                            <h6><label id="auth_amount">Authorized Amount : </label></h6>
                        
                            <div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger toCapture" > Confirm Payment </button>
                        </div>
                    </div>
                    </div>
                </div>

                <!--capture completed-->
                <div class="modal fade captureCompleted" id="captureCompleted" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Capture Payment Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="cp_para">

                            </div>

                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                    </div>
                </div>

              




<?=$this->endSection()?>

<?=$this->section('scripts') ?>


    
    <script>


        function authorizedOrders(){
            $.ajax({
                method:"GET",
                url:"getauthorders",
                success:function(response){
                    console.log(response);
                    $.each(response,function(key,value){
                        console.log(key,value);
                        $('.orderdata').append('<tr>\
                        <td class="c_order_id">'+value['order_id']+'</td>\
                        <td class="asdf">'+value['order_title']+'</td>\
                        <td>'+value['amount']+'</td>\
                        <td>'+value['status_message']+'</td>\
                        <td> <a href="#" class="badge btn btn-danger get-capture">Capture Payment</a>\
                        </td>\
                        </tr>');
                        
                    })
                }
            })
        }


        $(document).ready(function(){
            authorizedOrders();
        });



        $(document).on('click','.get-capture',function(){

            var order_id ={'order_id':$(this).closest('tr').find('.c_order_id').text()};
            console.log(order_id);
            $.ajax({
                method:"POST",
                url:"getauthtoken",
                data:order_id,
                success:function(response){
                   console.log(response.amount);
                    $.each(response,function(key,value){
                        console.log(key,value);
                    });

                    $('#auth_amount').append(response.amount);

                    $('.hidden_capture').append(
                        '<input type="hidden" name="authorization_token" id="authorization_token" value="'+response.authorization_token+'">'
                    )


                    
                }
            })

            $('.capturePayment').modal('show');
        })


        $(document).on('click','.toCapture',function(){
            $('.capturePayment').modal('hide');
            $('.captureCompleted').modal('show');
            var data={
                'authorization_token':$('#authorization_token').val(),
                'amount':$('#c_amount').val(),
               'reason':$('#c_reason').val()
            }

            $.ajax({
                method:"POST",
                url:"capturepayment",
                data:data,
                success:function(response){
                    if('payment_id' in response){
                        c_pay_id=$response.data.payment_id;
                    }else{
                        c_pay_id="No transaction made";
                    }

                    if('captured_amount' in response){
                        cp_amount=response.data.captured_amount
;
                    }else{
                        cp_amount=0;
                    }

                    $('#cp_para').append(
                        '<label>'+response.msg+'</label>\
                        <br><label>Payment ID : '+c_pay_id+'</label>\
                        <br><label>Captured Amount : '+cp_amount+'</label>'
                    )
                    console.log(response);
                    $('.capturePayment').modal('hide');
                    $('.captureCompleted').modal('show');
                }
            })
            

        })
        




        


    </script>


<?=$this->endSection()?>


