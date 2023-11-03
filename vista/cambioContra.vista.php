<!DOCTYPE html>
<html lang="en">
<!-- Raúl de Mingo Jiménez -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estils-login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Cambiar contraseña</title>
</head>
<body>
    <div class="login-box">
        <h2>Cambiar contraseña</h2>
        <form id="myform" action="../model/cambioContra.php?correo=<?php echo $_GET["correo"] ?>&token=<?php echo $_GET["token"] ?>" method="post">
            <input type="text" name="email" hidden value="<?php echo $_GET["correo"] ?>">
            <input type="text" name="token" hidden value="<?php echo $_GET["token"] ?>">
          <div class="user-box">
            <input type="password" name="pass1" required>
            <label>Contraseña</label>
          </div>
          <div class="user-box">
            <input type="password" name="pass2" >
            <label>Repite contraseña</label>
          </div>
          <input class="btn btn-primary" type="submit" onclick="<?php checkData() ?>" value="Login">
          <input class="btn btn-primary" type="reset" value="Reset">
        </form>
      </div>
</body>
</html>