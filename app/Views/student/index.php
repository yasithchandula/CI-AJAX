<?= $this->extend('layouts/frontend.php')?>

<?=$this->section('content') ?>
    <div class="container">
    <h2 style="text-align: center;">Student Management</h2>
    <br>
        <div class="row">
            <div class="col md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#studentModal">Add Student</a>
                    </div>

                    <div class="card-body">

            <table class="table table-bordered">
            <caption>List of users</caption>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">Department</th>
                    <th scope="col">Course</th>
                </tr>
            </thead>
            <tbody class="studentdata">
            </tbody>
            </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Student Add Modal-->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="studentModalLabel">Add Student</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <div class="form-group">
                            <label for="inputFirstName" class="form-label">First Name</label>
                            <span id='error_firstName' class='text-danger ms-3'></span>
                            <input type="text" class="form-control firstName"  name="firstName">
                        </div>
                        <div class="form-group">
                            <label for="inputLastName" class="form-label">Last Name</label>
                            <span id='error_lastName' class='text-danger ms-3'></span>
                            <input type="text" class="form-control lastName" name="lastName">
                        </div>
                        <div class="form-group">
                            <label for="inputBirthday" class="form-label">Birthday</label>
                            <span id='error_birthday' class='text-danger ms-3'></span>
                            <input type="date" class="form-control birthday" max="<?php echo date("Y-m-d");?>" name="birhtday">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="form-label">Email</label>
                            <span id='error_email' class='text-danger ms-3'></span>
                            <input type="text" class="form-control email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="form-label">Address</label>
                            <span id='error_address' class='text-danger ms-3'></span>
                            <input type="text" class="form-control address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="inputCity" class="form-label">City</label>
                            <span id='error_city' class='text-danger ms-3'></span>
                            <input type="text" class="form-control city" name="city">
                        </div>
                        <div class="form-group">
                            <label for="inputContact" class="form-label">Contact No</label>
                            <span id='error_contactNumber' class='text-danger ms-3'></span>
                            <input type="text" class="form-control contactNumber" name="contactNumber">
                        </div>
                        <div class="form-group">
                            <label for="inputDepartment" class="form-label">Department</label>
                            <span id='error_department' class='text-danger ms-3'></span>
                            <input type="text" class="form-control department" name="department">
                        </div>
                        <div class="form-group">
                            <label for="inputCourse" class="form-label">Course</label>
                            <span id='error_course' class='text-danger ms-3'></span>
                            <input type="text" class="form-control course" name="course">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="studentsave" class="studentsave btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>
    </div>

<!--Student Edit Modal-->
                <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="studentModalLabel">Update Student</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="form-group">
                            <label for="inputsID" class="form-label">Student ID</label>
                            <span id='error_sID' class='text-danger ms-3'></span>
                            <input type="text" id="sID" class="form-control sID" disabled>
                        </div>

                        <div class="form-group">
                            <label for="inputFirstName" class="form-label">First Name</label>
                            <span id='error_firstName' class='text-danger ms-3'></span>
                            <input type="text" id="firstName" class="form-control firstName"  >
                        </div>
                        <div class="form-group">
                            <label for="inputLastName" class="form-label">Last Name</label>
                            <span id='error_lastName' class='text-danger ms-3'></span>
                            <input type="text" id="lastName" class="form-control lastName" >
                        </div>
                        <div class="form-group">
                            <label for="inputBirthday" class="form-label">Birthday</label>
                            <span id='error_birthday' class='text-danger ms-3'></span>
                            <input type="date" id="birthday" class="form-control birthday" max="<?php echo date("Y-m-d");?>">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="form-label">Email</label>
                            <span id='error_email' class='text-danger ms-3'></span>
                            <input type="text" id="email" class="form-control email">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="form-label">Address</label>
                            <span id='error_address' class='text-danger ms-3'></span>
                            <input type="text" id="address" class="form-control address">
                        </div>
                        <div class="form-group">
                            <label for="inputCity" class="form-label">City</label>
                            <span id='error_city' class='text-danger ms-3'></span>
                            <input type="text" id="city" class="form-control city">
                        </div>
                        <div class="form-group">
                            <label for="inputContact" class="form-label">Contact No</label>
                            <span id='error_contactNumber' class='text-danger ms-3'></span>
                            <input type="text" id="contactNumber" class="form-control contactNumber" >
                        </div>
                        <div class="form-group">
                            <label for="inputDepartment" class="form-label">Department</label>
                            <span id='error_department' class='text-danger ms-3'></span>
                            <input type="text" id="department" class="form-control department" >
                        </div>
                        <div class="form-group">
                            <label for="inputCourse" class="form-label">Course</label>
                            <span id='error_course' class='text-danger ms-3'></span>
                            <input type="text" id="course" class="form-control course">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="studentupdate" class="studentupdate btn btn-primary">Update Student</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>


                    <?=$this->endSection()?>

<?=$this->section('scripts') ?>
    <script>
        /**
         * - Send student data to the controller
         */
        $(document).ready(function(){

            $(document).on('click','.studentsave',function(){

                if($.trim($('.firstName').val()).length==0){
                    error_firstName='Please Enter First Name';
                    $('#error_firstName').text(error_firstName);
                }
                else{
                    error_firstName='';
                    $('#error_firstName').text(error_firstName);
                }

                if($.trim($('.lastName').val()).length==0){
                    error_lastName='Please Enter last Name';
                    $('#error_lastName').text(error_lastName);
                }
                else{
                    error_lastName='';
                    $('#error_lastName').text(error_lastName);
                }

                if($.trim($('.birthday').val()).length==0){
                    error_birthday='Please Enter Birthday';
                    $('#error_birthday').text(error_birthday);
                }
                else{
                    error_birthday='';
                    $('#error_birthday').text(error_birthday);
                }

                if($.trim($('.email').val()).length==0){
                    error_email='Please Enter email';
                    $('#error_email').text(error_email);
                }
                else{
                    error_email='';
                    $('#error_email').text(error_email);
                }

                if($.trim($('.address').val()).length==0){
                    error_address='Please Enter address';
                    $('#error_address').text(error_address);
                }
                else{
                    error_address='';
                    $('#error_address').text(error_address);
                }

                if($.trim($('.city').val()).length==0){
                    error_city='Please Enter city';
                    $('#error_city').text(error_city);
                }
                else{
                    error_city='';
                    $('#error_city').text(error_city);
                }

                if($.trim($('.contactNumber').val()).length==0){
                    error_contactNumber='Please Enter contact Number';
                    $('#error_contactNumber').text(error_contactNumber);
                }
                else{
                    error_contactNumber='';
                    $('#error_contactNumber').text(error_contactNumber);
                }

                if($.trim($('.department').val()).length==0){
                    error_department='Please Enter department';
                    $('#error_department').text(error_department);
                }
                else{
                    error_department='';
                    $('#error_department').text(error_department);
                }

                if($.trim($('.course').val()).length==0){
                    error_course='Please Enter course';
                    $('#error_course').text(error_course);
                }
                else{
                    error_course='';
                    $('#error_course').text(error_course);
                }

                if(error_address!=''||error_birthday!=''||error_contactNumber!=''||error_course!=''||error_department!=''||error_firstName!=''||error_lastName!=''||error_city!=''||error_email!=''){
                    return false;
                }
                else{

                    var data ={
                        'firstName':$('.firstName').val(),
                        'lastName':$('.lastName').val(),
                        'birthday':$('.birthday').val(),
                        'email':$('.email').val(),
                        'address':$('.address').val(),
                        'city':$('.city').val(),
                        'contactNumber':$('.contactNumber').val(),
                        'course':$('.course').val(),
                        'department':$('.department').val(),
                    }
                    $.ajax({
                        method:"POST",
                        url:'student_store',
                        data:data,
                        success:function(response){
                            $('#studentModal').modal('hide');
                            $('#studentModal').find('input').val('');
                            alertify.set('notifier','position','top-right');
                            if(response.status){

                                alertify.success(response.status);
                                location.reload();
                            }
                            else{

                                alertify.error(response.error);
                            }
                            

                        }
                    })

                }
                
            });
        });
    </script>

    <script>

        /**
         * - Load All courses from the database
         */
        $(document).ready(function(){
            loadStudent();
        });

        /**
         * - Listning to click on edit button
         * - Load the Course edit modal and pass the parameters to input fields on the modal
         */
        $(document).on('click','.edit-btn',function(){
            var sID = $(this).closest('tr').find('.sID').text();
            console.log(sID);
            $.ajax({
                method:"POST",
                url:"student_edit",
                data : {
                    "sID":sID
                },
                success:function(response){
                    console.log(response);
                    $.each(response,function(key,value){
                        $('#sID').val(value['sID']);
                        $('#firstName').val(value['firstName']);
                        $('#lastName').val(value['lastName']);
                        $('#birthday').val(value['birthday']);
                        $('#email').val(value['email']);
                        $('#address').val(value['address']);
                        $('#city').val(value['city']);
                        $('#contactNumber').val(value['contactNumber']);
                        $('#department').val(value['department']);
                        $('#course').val(value['course']);
                        $('#studentEditModal').modal('show');
                    })

                    }
            })

        })

        /**
         * - update the course details
         * - Sends the values stored in input fields of the model
         */

        $(document).on('click','.studentupdate',function(){
            console.log("HIII ")
            alertify.confirm("Do you want to update the student",function(e){
                if(e){

                    var data ={
                        'sID':$('#sID').val(),
                        'firstName':$('#firstName').val(),
                        'lastName':$('#lastName').val(),
                        'birthday':$('#birthday').val(),
                        'email':$('#email').val(),
                        'address':$('#address').val(),
                        'city':$('#city').val(),
                        'contactNumber':$('#contactNumber').val(),
                        'course':$('#course').val(),
                        'department':$('#department').val(),
                    }

                    $.ajax({
                        method:"POST",
                        url:"student_update",
                        data:data,
                        success:function(response){

                            $('#studentModal').modal('hide');
                            $('#studentModal').find('input').val('');
                            alertify.set('notifier','position','top-right');
                                    if(response.status){
                                        alertify.success(response.status);
                                        location.reload();
                                    }
                                    else{

                                        alertify.error(response.error);
                                    }
                        }
                    })

                }
                else{

                    return false;
                }
            })
            

        })

        /**
         * 
         * - listning to delete button 
         * - delete the clicked record from the database
         */
        $(document).on('click','.delete-btn',function(){
            console.log('hii')
            var sID = $(this).closest('tr').find('.sID').text();
            alertify.confirm("Are you want to delete the student",function(e){
                if(e){
                    console.log(sID);
                    $.ajax({
                    method:"POST",
                    url:"student_delete",
                    data : {
                        "sID":sID
                    },
                    success:function(response){
                        if(response.status){
                                        alertify.success(response.status);
                                        location.reload();
                                    }
                                    else{

                                        alertify.error(response.error);
                                    }
                } 
                })
                }
                else{

                    return false;
                }
            })

    })

        /**
         * Load all the course records from the database
         */

        function loadStudent(){
            $.ajax({
                method:"GET",
                url:"student_fetch",
                success:function(response){
                    console.log(response);

                    $.each(response.student,function(key,value){
                        $('.studentdata').append('<tr>\
                        <td class="sID">'+value['sID']+'</td>\
                        <td>'+value['firstName']+'</td>\
                        <td>'+value['lastName']+'</td>\
                        <td>'+value['birthday']+'</td>\
                        <td>'+value['email']+'</td>\
                        <td>'+value['contactNumber']+'</td>\
                        <td>'+value['address']+'</td>\
                        <td>'+value['city']+'</td>\
                        <td>'+value['department']+'</td>\
                        <td>'+value['course']+'</td>\
                        <td> <a href="#" class="badge btn btn-primary edit-btn">Edit</a>\
                            <a href="#" class="badge btn btn-danger delete-btn">Delete</a>\
                        </td>\
                        </tr>');
                    })
                }
            })
        }


    </script>


<?=$this->endSection()?>


