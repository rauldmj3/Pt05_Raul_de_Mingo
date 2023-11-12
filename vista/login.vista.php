<!DOCTYPE html>
<html lang="en">
<!-- Raúl de Mingo Jiménez -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estils-login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="262008330769-0hlfpr5uslt73c6ni8c5b48qkf6350ip.apps.googleusercontent.com">
    <title>Login</title>
</head>
<body>
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <form id="myform" action="../model/login.php" method="post">
          <div class="user-box">
            <input type="text" name="email" required>
            <label>Correo</label>
          </div>
          <div class="user-box">
            <input type="password" name="pass" >
            <label>Contraseña</label>
          </div>
          <input class="btn btn-primary" type="submit" onclick="<?php checkData() ?>" value="Login">
          <input class="btn btn-primary" type="reset" value="Reset">
          <br><br>
            <?php recaptcha() ?>
          <input class="btn btn-primary" type="submit" value="Recuperar contraseña" onclick="<?php enviarCorreo()?>">
        </form>
        <br>
        <p style="color:white;font-size:smaller">Para recuperar la contraseña pon primero tu correo.</p>
        <br><br>
          <?php include "redirect.php"; ?>
      </div>
</body>
</html>