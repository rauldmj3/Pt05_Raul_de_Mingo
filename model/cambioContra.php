<?php
//Raúl de Mingo Jiménez
include "../controlador/controlador.php";

function checkData(){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $pass1=validar($_POST["pass1"]);
        $pass2=validar($_POST["pass2"]);
        $email=validar($_POST["email"]);
        $token=$_POST["token"];
        if(checkPass($pass1,$pass2) && checkToken($email,$token)){
            cambiarContra($email,$pass1);
            login($email);
        }
    }
}

function login($email){
    session_start();
    $_SESSION["email"]= $email;
    $_SESSION['loggedin'] = true;
    header("Location: ../model/index.php"); 
}

function cambiarContra($email,$pass){
    $newPass= encriptar($pass);
    $con=conDB();
    $stt=$con->prepare("UPDATE users SET password=:pass, token_reset=null, expires=null WHERE email=:email");
    $stt->execute(["email"=>$email,"pass"=>$newPass]);
}

function checkToken($email,$token){
    $con=conDB();
    $stt=$con->prepare("SELECT token_reset FROM users WHERE email=:email");
    $stt->execute(["email"=>$email]);
    $tokenBD=$stt->fetch(PDO::FETCH_ASSOC);
    if($tokenBD==$token) return true;
    else return false;
}

require "../vista/cambioContra.vista.php";
?>