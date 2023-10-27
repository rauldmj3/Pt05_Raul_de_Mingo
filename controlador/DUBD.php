<?php
include_once "controlador.php";
    if (isset($_POST['esborrar'])) {
        esborrar($_POST['id']);
    }
    if (isset($_POST['modificar'])) {
        modificar($_POST['id']);
    }
    function esborrar($id){
        $con=conDB();
        $stt=$con->prepare("DELETE FROM articles WHERE id=:id");
        $stt->execute(["id"=>$id]);
    } 

    function modificar($id){
        $con=conDB();
        $stt=$con->prepare("SELECT article FROM articles WHERE id=:id");
        $stt->execute(["id"=>$id]);
        $article=$stt->fetchAll(PDO::FETCH_ASSOC);
        echo "<input type='text' value='".$article."'>
            <button ></button>
        ";
    } 

    require '../model/index.php';
?>