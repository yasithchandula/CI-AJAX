<?= $this->extend('layouts/frontend.php')?>

<?=$this->section('content') ?>
<div class="container">
    <div class="row">

        <div class="col md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Student
                    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">Add Student</a>
                    </h4>
                </div>

                <div class="card-body">
                    <!-- Modal -->
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
                            <input type="text" class="form-control"  name="firstName">
                        </div>
                        <div class="form-group">
                            <label for="inputLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastName">
                        </div>
                        <div class="form-group">
                            <label for="inputBirthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" max="<?php echo date("Y-m-d");?>" name="birhtday">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address">
                        </div>
                        <div class="form-group">
                            <label for="inputContact" class="form-label">Contact No</label>
                            <input type="text" class="form-control" name="contactNumber">
                        </div>
                        <div class="form-group">
                            <label for="inputDepartment" class="form-label">Department</label>
                            <input type="text" class="form-control" name="department">
                        </div>
                        <div class="form-group">
                            <label for="inputCourse" class="form-label">Course</label>
                            <input type="text" class="form-control" name="course">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary studentsave">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection()?>

<?=$this->section('scripts')?>
    <script>
        $(document).ready(function(){

            $(document).on('click','.studentsave',function(){
                alert("hello");
            });
        });
    </script>
<?=$this->endSection()?>


