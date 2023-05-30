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
    <div class="centered-container">
    <div class="card">
        <div class="card-body">
        <h2 class="card-title">Student Login</h2>
        <?php
                /**
                 * - check weather if there are any erros in the response.
                 * - if errors present, the list of errors will be displayed.
                 */
                if (session('errors')) :?>
                    <?php $erros['errors']=session('errors');
                   ?>
                    <div class="text-danger">
                        <ul>
                            <?php foreach ($erros['errors'] as $error):?>
                            <li><?=$error?></li>
                            <?php endforeach?>
                        </ul>
                    </div>
                <?php endif ?>
        <form action="<?=base_url("client/login")?>" method="POST">
            <div class="form-group">
            <label for="username">Student ID:</label>
            <input type="username" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        </div>
    </div>
    </div>

</body>
</html>
