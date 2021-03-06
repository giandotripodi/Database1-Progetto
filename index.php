<?php 
  require_once "autenticazione.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Login </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="login-page">
        <div class="form">
            <h3>Login alla piattaforma</h3>
          <form class="login-form" id="form" method="post">
            <input type="text" name="email" placeholder="Email"/>
            <input type="password" name="pass" placeholder="Password"/>
            <input type="submit" value="LOGIN" name="login">
            <span><?php echo @$error; ?></span>
          </form>
        </div>
      </div>
    </body>
</html>
