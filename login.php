<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: /polizas/index.php');
}
require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])&& !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT users.* FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    
    $message = '';
    
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: /polizas/index.php");
    } else {
        echo '<script language="javascript">alert("Error de autentificacion");window.location.href="/polizas/login.php"</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta http-equiv=�Content-Type� content=�text/html; charset=utf-8? />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AutoWarranty </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.blue.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
     <link rel="shortcut icon" href="img/favicon.ico"> 
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
<body>
    <div class="login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>AutoWarranty </h1>
                  </div>
                  <p>Sistema de generación de polizas.</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form action="login.php" method="POST" class="form-validate">
                    <div class="form-group">
                      <input name="email" id="email" type="text" required data-msg="Introduce tu usuario" class="input-material">
                      <label for="login-username" class="label-material">Usuario</label>
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" name="password" required data-msg="Introduce tu password" class="input-material">
                      <label for="login-password" class="label-material">Password</label>
                    </div><button type="submit" value="Submit" class="btn btn-primary btn-block">Login</button>
                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                  </form>
<!--                   <a href="#" class="forgot-pass">Forgot Password?</a><br><small>Do not have an account? </small><a href="register.html" class="signup">Signup</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyrights text-center">
         <p>2021 &copy; LOBDRA. <a target="_blank" href="#">kartegen@gmail.com</a>.</p>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>