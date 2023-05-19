<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
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

    .form-control {
      width: 100%;
    }
  </style>
</head>
<body style="background-color:#f0f1f2;">
<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
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

    .form-control {
      width: 100%;
    }
  </style>
</head>
<body>

<div class="centered-container">
  <div class="card">
    <div class="card-body">
      <h2 class="card-title">Registration</h2>

      <?php
        /**
         * - check weather if there are any erros in the response.
         * - if errors present, the list of errors will be displayed.
         */
        if (session('errors')) :?>

            <?php $errors=[];
            $errors=session('errors');?>
            
                <div class="text-danger">
                    <ul>
                        <?php foreach ($errors as $error):?>
                        <li><?=$error?></li>
                        <?php endforeach?>
                    </ul>
                </div>

        <?php endif ?>

      <form action="<?=base_url('user_store')?>" method="POST">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" name="username" id="username">
        </div>
        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
      <p class="mt-3">Already have an account? <a href="<?=base_url("/")?>">Login here</a></p>
    </div>
  </div>
</div>

</body>
</html>


</body>
</html>
