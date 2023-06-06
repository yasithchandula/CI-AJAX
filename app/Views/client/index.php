<?= $this->extend('layouts/frontend_client.php')?>

<?=$this->section('content_client') ?>
    <div class="container">
    <h2 style="text-align: center;">All Courses</h2>
    <br>
        <div class="row">
            
            <div class="col md-12">
                <div class="card">
                    <div class="card-header">


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





<?=$this->endSection()?>




<?=$this->section('scripts_client') ?>




<?=$this->endSection()?>

