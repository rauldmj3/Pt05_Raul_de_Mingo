<?php
    session_start();
    $_SESSION["email"]= $email;
    $_SESSION['loggedin'] = true;
    header("Location: ../model/index.php"); 
    exit();
?>