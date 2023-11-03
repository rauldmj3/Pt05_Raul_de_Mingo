<?php
    
    include_once "../controlador/controlador.php";
    
    if (isset($_POST["article"])) {
        $con= conDB();
        $stt=$con->prepare("INSERT INTO articles (id,article,autor) VALUES (,:article,:autor)");
        $stt->bindParam(":article", $_POST["article"]);
        $stt->bindParam(":autor", $_SESSION["email"]);
        $stt->execute();
    }

    require "../vista/inserir.vista.php";

?>