<?php
//Raúl de Mingo Jiménez
include "../controlador/controlador.php";

function checkData(){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name=validar($_POST["name"]);
        $email=validar($_POST["email"]);
        $pass=validar($_POST["pass"]);
        $pass2=validar($_POST["pass2"]);
        if(!strcmp($pass,$pass2)){
            $finalPass=encriptar($pass);
            register($email,$name,$finalPass);
        }
    }
}

function register($email,$name,$finalPass){
    try{
        $con=conDB();
        $stt=$con->prepare("INSERT INTO users(email,username,password) VALUES (:email,:username,:password)");
        $stt->execute([":email"=>$email,":username"=>$name,":password"=>$finalPass]);
    }catch(PDOException $e){
        echo($e);
    }finally{
        require_once "../controlador/session.php";
    }
}

require '../vista/register.vista.php';
?>