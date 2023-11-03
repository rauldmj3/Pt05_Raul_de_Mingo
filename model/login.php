<?php
//Raúl de Mingo Jiménez
include "../controlador/controlador.php";

function checkData(){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email=validar($_POST["email"]);
        $pass=validar($_POST["pass"]);
        if(checkPass($email,$pass)){
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

function enviarCorreo(){
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email=validar($_POST["email"]);
        if(checkEmail($email)){
            $url="http://".$_SERVER['SERVER_NAME']."/Back-End/UF2/Pt05_Raul_de_Mingo/model/cambioContra.php?correo=".$email."&token=";
            $url.= generarToken($email);
            mail($email,"RECUPERAR CONTRASEÑA","Cambia tu contraseña desde este link: ".$url);
        }
    }
}

function checkEmail($email){
    $con=conDB();
    $stt=$con->prepare("SELECT * FROM users WHERE email=:email");
    $stt->execute(array(":email"=>$email));
    $result=$stt->fetch(PDO::FETCH_ASSOC);
    if(empty($result)){
        return false;
    }else return true;
}
function generarToken($email){
    $token=bin2hex(openssl_random_pseudo_bytes(16));
    $con=conDB();
    $stt=$con->prepare("UPDATE users SET token_reset=:token, expires=NOW() +INTERVAL 3 HOUR WHERE email=:email");
    $stt->execute(array("email"=>$email,"token"=>$token));
    return $token;
}
require '../vista/login.vista.php';
?>