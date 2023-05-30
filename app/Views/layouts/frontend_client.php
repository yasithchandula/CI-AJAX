<!doctype html>
<html lang="en">

  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
  </head>
  <body style="background-color:#f0f1f2;">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <div class="app">
        <?=$this->include('layouts/header_client.php')?>
        <br>
        <?=$this->renderSection('content_client')?>
        <?=$this->renderSection('scripts_client')?>
    </div>



    <!--Client Pay Modal-->
    <div class="modal fade" id="clientPay" tabindex="-1" aria-labelledby="clientPayLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="clientPayLabel">Enter Payment Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="inputcID" class="form-label">Course ID</label>
                        <span id='error_cID' class='text-danger ms-3'></span>
                        <input type="text" id="cIDd" name="cID" class="form-control cIDN" disabled>

                    </div>

                    <div class="form-group">
                        <label for="inputCourse" class="form-label">Course</label>
                        <span id='error_course' class='text-danger ms-3'></span>
                        <input type="text" id="course" name="course" class="form-control course" disabled>
                    </div>

                    <div class="form-group">
                        <label for="inputFee" class="form-label">Course Fee</label>
                        <span id='error_fee' class='text-danger ms-3'></span>
                        <input type="text" id="fee" name="fee" class="form-control fee"  disabled>
                    </div>

                    <div class="form-group">
                        <label for="inputFirstName" class="form-label">First Name</label>
                        <span id='error_firstName' class='text-danger ms-3'></span>
                        <input type="text" id="firstName" name="firstName" class="form-control firstName"  >
                    </div>
                    <div class="form-group">
                        <label for="inputLastName" class="form-label">Last Name</label>
                        <span id='error_lastName' class='text-danger ms-3'></span>
                        <input type="text" id="lastName" name="lastName" class="form-control lastName" >
                    </div>

                    <div class="form-group">
                        <label for="inputEmail" class="form-label">Email</label>
                        <span id='error_email' class='text-danger ms-3'></span>
                        <input type="text" id="email" name="email" class="form-control email" >
                    </div>

                    <div class="form-group">
                        <label for="inputContact" class="form-label">Phone</label>
                        <span id='error_contactNumber' class='text-danger ms-3'></span>
                        <input type="text" id="contactNumber" name="contactNumber" class="form-control contactNumber" >
                    </div>

                    <div class="form-group">
                        <label for="inputAddress" class="form-label">Address</label>
                        <span id='error_address' class='text-danger ms-3'></span>
                        <input type="text" id="address" name="address" class="form-control address">
                    </div>

                    <div class="form-group">
                        <label for="inputcity" class="form-label">city</label>
                        <span id='error_city' class='text-danger ms-3'></span>
                        <input type="text" id="city" name="city" class="form-control city">
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="payNow" class="payNow btn btn-danger">Pay now</button>
                    </div>
                    </div>
                </div>
        </div>
      </div>


    <!--To Payhere Modal-->
    <div class="modal fade" id="to_phere" tabindex="-1" aria-labelledby="clientPayLabel" aria-hidden="true">
                <form id='toPayhere' action="https://sandbox.payhere.lk/pay/checkout"  method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="clientPayLabel">Confirm Payment</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <div class="input_hidden">

                        </div>
                        

                        <div class="modal-footer">
                            <button type="submit"  class="btn btn-danger">Confirm Payment</button>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                </form>

            </div>

        <!--Preapproval Payment-->
        <div class="modal fade" id="preapproval_payment" tabindex="-1" aria-labelledby="clientPayLabel" aria-hidden="true">
                <form id='toPayhere' action="https://sandbox.payhere.lk/pay/preapprove"  method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="clientPayLabel">Confirm Payment</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label>By confirming, you will be charged each time when you want to get a service.</label>

                        <div class="input_hidden">

                        </div>
                        <br>
                        <label>Pay with Javascript SDK : </label>
                        <button type="button" class="btn btn-danger js_preapproval"> Pay With JS PR</button>
                        <br>...
                        
                        <div class="modal-footer">
                            <button type="submit"  class="btn btn-danger">Confirm Payment</button>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                </form>

            </div>




    <!--Recursive Model-->
    <div class="modal fade" id="recursive_payment" tabindex="-1" aria-labelledby="clientPayLabel" aria-hidden="true">
                <form id='toPayhere' action="https://sandbox.payhere.lk/pay/checkout"  method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="clientPayLabel">Confirm Payment</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <div class="form-group">
                        <label class="form-label"> <h5> Pay Monthly In :     </h5></label>
                        <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-outline-danger" name="duration" value="3 Month">3 Months</button>
                        <button type="submit" class="btn btn-outline-danger" name="duration" value="6 Month">6 Months</button>
                        <button type="submit" class="btn btn-outline-danger" name="duration" value="1 Year">1 Year</button>
                        <input type="hidden" name="recurrence" value = "1 Month">
                        </div>
                        </div>

                        <div class="input_hidden">

                        </div>
                        
                        </div>
                    </div>
                    </div>
                </form>

    </div>

    


    <!-- Payment Modal-->
    <div class="modal fade" id="payment" tabindex="-1" aria-labelledby="clientPayLabel" aria-hidden="true">

                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="clientPayLabel">Select Payment Method</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <!-- <div class="input_hidden">

                        </div> -->

                        <div class="form-group">
                        <label for="inputcity" class="form-label"><h5>Pay with Payhere checkout :</h5></label>
                        <button type="button" id="paynowbtn"  class="btn btn-warning btn-lg paynowbtn">PayHere Pay</button>

                        </div><br>

                        <div class="form-group">
                        <label for="inputcity" class="form-label"><h5>Pay with Payhere JS SDK   : </h5></label>
                        <button class="btn btn-warning btn-lg" type="submit" class="payhere-payment" id="payhere-payment" >PayHere Pay</button>
                            
                        </div><br>

                        <div class="form-group">
                        <label for="inputcity" class="form-label"><h5>Pay in terms   : </h5></label>
                        <button class="btn btn-warning btn-lg recuring_payment" type="submit" id="recuring_payment" >PayHere Pay</button>
                            
                        </div><br>

                        <div class="form-group">
                        <label for="inputcity" class="form-label"><h5>Preapproval : </h5></label>
                        <button class="btn btn-warning btn-lg preapproval" type="submit" id="preapproval" >PayHere Pay</button>
                            
                        </div><br>

                        <div class="modal-footer">
                            <button type="submit"  class="btn btn-danger">Confirm Payment</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
            </div>


    <script>
        /**
         * - Load All courses from the database
         */

        $(document).ready(function(){
            loadcourse();
        });

        // const buttonOptions = document.querySelectorAll()




        /**
         * - Listning to click on edit button
         * - Load the Course edit modal and pass the parameters to input fields on the modal
         */
        $(document).on('click','.pay-btn',function(){
            var cID = $(this).closest('tr').find('.cID').text();
            console.log(cID);
            $.ajax({
                method:"POST",
                url:"course_edit",
                data : {
                    "cID":cID
                },
                success:function(response){
                    console.log(response)
                    $('#idup').val(response['id']);
                    $('#cIDd').val(response['cID']);
                    $('#fee').val(response['fee']);
                    $('#department').val(response['Department']);
                    $('#course').val(response['Course']);
                    $('#firstName').val(response['firstName']);
                    $('#lastName').val(response['lastName']);
                    $('#email').val(response['email']);
                    $('#contactNumber').val(response['contactNumber']);
                    $('#address').val(response['address']);
                    $('#city').val(response['city']);
                    $('#clientPay').modal('show');
                    }
            })

        });




        $(document).on('click','.paynowbtn',function(){
            $('#payment').modal('hide');
            $('#to_phere').modal('show');
        })

        $(document).on('click','.recuring_payment',function(){
            $('#payment').modal('hide');
            $('#recursive_payment').modal('show');
        })

        $(document).on('click','.preapproval',function(){
            $('#payment').modal('hide');
            $('#preapproval_payment').modal('show');
        })

        
        /**
         * - checkout js sdk
         */
        
        $(document).on('click','#payhere-payment',function(){

            var payment = {
                "sandbox": true,
                "merchant_id": $('#js_merchant_id').val(),    // Replace your Merchant ID
                "return_url": $('#js_return_url').val(),     // Important
                "cancel_url": $('#js_cancel_url').val(),     // Important
                "notify_url": $('#js_notify_url').val(),
                "order_id": $('#js_order_id').val(),
                "items": $('#js_items').val(),
                "amount": $('#js_amount').val(),
                "currency": $('#js_currency').val(),
                "hash": $('#js_hash').val(), // *Replace with generated hash retrieved from backend
                "first_name":$('#js_first_name').val(),
                "last_name": $('#js_last_name').val(),
                "email": $('#js_email').val(),
                "phone": $('#js_phone').val(),
                "address": $('#js_address').val(),
                "city": $('#js_city').val(),
                "country": $('#js_country').val(),
                "delivery_address": $('#js_address').val(),
                "delivery_city": $('#js_city').val(),
                "delivery_country": $('#js_country').val(),
                "custom_1": "",
                "custom_2": ""
            };
            
            console.log();
            payhere.startPayment(payment);
            delete(payment);
        });

        /**
         * - preapproval sdk 
         */

        $(document).on('click','.js_preapproval',function(){

        var payment = {
            "preapprove":true,
            "merchant_id": $('#js_merchant_id').val(),    // Replace your Merchant ID
            "return_url": $('#js_return_url').val(),     // Important
            "cancel_url": $('#js_cancel_url').val(),     // Important
            "notify_url": $('#js_notify_url').val(),
            "order_id": $('#js_order_id').val(),
            "items": $('#js_items').val(),
            "amount": $('#js_amount').val(),
            "currency": $('#js_currency').val(),
            "hash": $('#js_hash').val(), // *Replace with generated hash retrieved from backend
            "first_name":$('#js_first_name').val(),
            "last_name": $('#js_last_name').val(),
            "email": $('#js_email').val(),
            "phone": $('#js_phone').val(),
            "address": $('#js_address').val(),
            "city": $('#js_city').val(),
            "country": $('#js_country').val(),
            "delivery_address": $('#js_address').val(),
            "delivery_city": $('#js_city').val(),
            "delivery_country": $('#js_country').val(),
            "custom_1": "",
            "custom_2": ""
        };

        console.log();
        payhere.startPayment(payment);
        delete(payment);
        });




        $(document).on('click','.payNow',function(){

            var data ={
                        'sID':'19',
                        'cID':$('.cIDN').val(),
                        'fee':$('.fee').val(),
                        'course':$('.course').val(),
                        'firstName':$('.firstName').val(),
                        'lastName':$('.lastName').val(),
                        'email':$('.email').val(),
                        'contactNumber':$('.contactNumber').val(),
                        'address':$('.address').val(),
                        'city':$('.city').val(),
                    }

            $.ajax({
                method:"POST",
                url:'client_pay',
                data:data,
                success:function(response){
                    console.log(response);
                    $('#clientPay').modal('hide');
                    $('#clientPay').find('input').val('');

                    alertify.set('notifier','position','top-right');

                    $.each(response,function(key,value){
                        console.log(key,value)
                        $('.input_hidden').append(
                        '<input type="hidden" id="js_'+key+'" name="' + key + '" value="' + value + '">');
                        $('#payment').modal('show');


                    })
                    

                }
            })

            
        });



    /**
     * Load all the course records from the database
     */

        function loadcourse(){
            $.ajax({
                method:"GET",
                url:"course_fetch",
                success:function(response){
                    console.log(response.course);

                    $.each(response.course,function(key,value){
                        $('.coursedata').append('<tr>\
                        <td class="cID">'+value['cID']+'</td>\
                        <td>'+value['Course']+'</td>\
                        <td>'+value['Department']+'</td>\
                        <td>'+value['fee']+'</td>\
                        <td> <a href="#" class="badge btn btn-danger pay-btn">Pay</a>\
                        </td>\
                        </tr>');
                    })
                }
            })
        }


    </script>


<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


<script>



        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:"  + error);
    };


    console.log($('#email').val());

    // // // Show the payhere.js popup, when "PayHere Pay" is clicked
    // document.getElementById('payhere-payment').onclick = function (e) {
    //     payhere.startPayment(payment);
    // };




</script>







</body>
</html>
