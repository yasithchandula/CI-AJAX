<?= $this->extend('layouts/frontend.php')?>

<?=$this->section('content') ?>
    <div class="container">
    <h2 style="text-align: center;">Course Management</h2>
    <br>
        <div class="row">
            
            <div class="col md-12">
                <div class="card">
                    <div class="card-header">

                        <a style="align-items: end;"  href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#courseModal">Add Course</a>

                    </div>

                    <div class="card-body">

            <table class="table table-bordered">
            <caption>List of users</caption>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Course</th>
                    <th scope="col">Department</th>
                    <th scope="col">Fee</th>
                    <th scope="col">Actions</th>
                    
                </tr>
            </thead>
            <tbody class="coursedata">
            </tbody>
            </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--course Add Modal-->
    <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Add course</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <div class="form-group">
                            <label for="inputcID" class="form-label">Course ID</label>
                            <span id='error_cID' class='text-danger ms-3'></span>
                            <input type="text" class="form-control cIDd" id="cIDd" name="cID">
                        </div>
                        <div class="form-group">
                            <label for="inputfee" class="form-label">Fee</label>
                            <span id='error_fee' class='text-danger ms-3'></span>
                            <input type="text" class="form-control fee" name="fee">
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
                            <button type="button" id="coursesave" class="coursesave btn btn-success">Add Course</button>
                        </div>
                        </div>
                    </div>
                    </div>
    </div>

<!--course Edit Modal-->
                <div class="modal fade" id="courseEditModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="courseModalLabel">Update course</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <input type="hidden" class="form-control cID" id="idup" >
                        
                        <div class="form-group">
                            <label for="inputcID" class="form-label">Course ID</label>
                            <input type="text" id="cID" class="form-control cID" name="cID" disabled>
                        </div>

                        <div class="form-group">
                            <label for="inputfee" class="form-label">Course Fee</label>
                            <span id='error_fee' class='text-danger ms-3'></span>
                            <input type="text" id="fee" class="form-control fee" name="fee">
                        </div>
                        <div class="form-group">
                            <label for="inputDepartment" class="form-label">Department</label>
                            <span id='error_department' class='text-danger ms-3'></span>
                            <input type="text" id="department" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputCourse" class="form-label">Course</label>
                            <span id='error_course' class='text-danger ms-3'></span>
                            <input type="text" id="course" class="form-control" >
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="courseupdate" class="courseupdate btn btn-primary">Update course</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>


                    <?=$this->endSection()?>

<?=$this->section('scripts') ?>
    <script>

        /**
         * - Sends student data to the controller
         */
        $(document).ready(function(){

            $(document).on('click','.coursesave',function(){

                if($.trim($('.cIDd').val()).length==0){
                    error_fee='Please Enter Course ID';
                    $('#error_cID').text(error_fee);
                }
                else{
                    error_fee='';
                    $('#error_cID').text(error_fee);
                }


                if($.trim($('.fee').val()).length==0){
                    error_fee='Please Enter fee Number';
                    $('#error_fee').text(error_fee);
                }
                else{
                    error_fee='';
                    $('#error_fee').text(error_fee);
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

                if(error_fee!=''||error_course!=''||error_department!=''){
                    return false;
                }
                else{

                    var data ={
                        'cID':$('.cIDd').val(),
                        'fee':$('.fee').val(),
                        'course':$('.course').val(),
                        'department':$('.department').val(),
                    }
                    console.log(data);
                    $.ajax({
                        method:"POST",
                        url:'course_store',
                        data:data,
                        success:function(response){
                            $('#courseModal').modal('hide');
                            $('#courseModal').find('input').val('');
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
            loadcourse();
        });


        /**
         * - Listning to click on edit button
         * - Load the Course edit modal and pass the parameters to input fields on the modal
         */
        $(document).on('click','.edit-btn',function(){
            var cID = $(this).closest('tr').find('.cID').text();
            console.log(cID);
            $.ajax({
                method:"POST",
                url:"course_edit",
                data : {
                    "cID":cID
                },
                success:function(response){
                    console.log(response);
                    $.each(response,function(key,value){
                        $('#idup').val(value['id']);
                        $('#cID').val(value['cID']);
                        $('#fee').val(value['fee']);
                        $('#department').val(value['Department']);
                        $('#course').val(value['Course']);
                        $('#courseEditModal').modal('show');
                    })

                    }
            })

        })

        /**
         * - update the course details
         * - Sends the values stored in input fields of the model
         */

        $(document).on('click','.courseupdate',function(){
            alertify.confirm("Do you want to update the course",function(e){
                if(e){

                    var data ={
                        'id':$('#idup').val(),
                        'cID':$('#cID').val(),
                        'fee':$('#fee').val(),
                        'course':$('#course').val(),
                        'department':$('#department').val(),
                    }

                    $.ajax({
                        method:"POST",
                        url:"course_update",
                        data:data,
                        success:function(response){
                            $('#courseModal').modal('hide');
                            $('#courseModal').find('input').val('');
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
            var cID = $(this).closest('tr').find('.cID').text();
            alertify.confirm("Are you want to delete the course",function(e){
                if(e){
                    console.log(cID);
                    $.ajax({
                    method:"POST",
                    url:"course_delete",
                    data : {
                        "cID":cID
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


