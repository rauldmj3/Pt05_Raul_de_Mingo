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

    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["email"])){
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

function recaptcha(){
        echo '<div class="g-recaptcha" data-sitekey="6LdrZf4oAAAAANkDI3iHgcW4BS__7opPbrCp70yi"></div><br><br>';
        if(isset($_POST['submit']) && $_POST['submit'] == 'SUBMIT'){
          if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
          {
                $secret = '6LdrZf4oAAAAAFc1Zzy7zGwAKc3S4U0b5r0YTyDQ';
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);
                if($responseData->success)
                    echo '<div style="color: limegreen;"><b>Your contact request have submitted successfully.</b></div>';
                else
                    echo '<div style="color: red;"><b>Robot verification failed, please try again.</b></div>';
          }else{
              echo '<div style="color: red;"><b>Please do the robot verification.</b></div>';
          }
        }
}

include_once '../vista/login.vista.php';
?>