
<!DOCTYPE html>
<html>
<head>
  <title>User Index Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .centered-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .card {
      width: 400px;
    }

    .btn-group {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="centered-container">
  <div class="card">
    <div class="card-body">
      <h2 class="card-title">User Index</h2>
      <div class="btn-group">
        <a href="<?=base_url("student")?>" class="btn btn-primary">Student Management</a>
        <a href="<?=base_url("course")?>" class="btn btn-primary">Course Management</a>
        <a href="<?=base_url("user_logout")?>" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>
