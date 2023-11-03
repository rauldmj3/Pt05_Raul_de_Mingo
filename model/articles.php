<?php 
//Raúl de Mingo Jiménez
include_once "../controlador/controlador.php";
/**
 * Si es la primera vez que se abre la pagina se introducen los valores por defecto que tiene que haber en la pagina, como el numero de articulos por pagina y 
 * el numero de la pagina. Despues llama a la funcion para hacer la conexion con la base de datos y devuelve todos los articulos que sean mas grande que el id
 * que se le pasa por parametro. Y luego con un bucle foreach se preparan los articulos para mostrarlos por pantalla hasta el numero de articulos que sean necesarios
 * y se van concatenando en una variable que al final, la muestra por pantalla.
 *
 * @return void no devuelve nada ya que lo muestra por pantalla
 */
function mostrar(){
    if(isset($_SESSION["email"]))$email=$_SESSION["email"];
    else $email="";
    if(!isset($_GET["article"])){
        $numArtPag=5;
        $numId=0;
    }else{
        $numArtPag=intval($_GET["article"]);
        $numId=(intval($_GET["page"])-1)*intval($numArtPag);
    }
    $articles=[];
    try{
        $con = conDB();
        $stt= $con->prepare('SELECT * FROM articles WHERE id>:id AND autor=:email');
        $stt->execute([":id"=>$numId,":email"=>$email]);
        $articles = $stt->fetchAll();
    }catch(PDOException $e){
        echo $e;
    }
    $lista="";
    $i=0;
    foreach($articles as $article){

        if($i<$numArtPag && $article["autor"]==$email) {
            $lista .="<form action='../controlador/DUBD.php' method='post'><li>".$article["id"]."-.".$article["article"]." <br><strong>By:</strong> ".$article["autor"]."
            <br><input type='submit' class='button' name='esborrar' value='Esborrar' />  <input type='submit' class='button' name='modificar' value='Modificar' /><input type='hidden' name='id' value=".$article["id"].">
            </li></form>" ;
        }else break;
        $i++;
    }
    $con=null;
    echo $lista;
}


/**
 * Si es la primera vez que se abre la pagina se introducen los valores por defecto que tiene que haber en la pagina, como el numero de articulos por pagina y 
 * el numero de la pagina. Comprueba si esta en la pagina 1 si es asi bloqueara los botones para moverse una pagina a la izquierda si no los dejara desbloqueados.
 * Despues con un bucle for se concatenan todos los botones con el numero de paginas. Y por ultimo comprueba si la pgina actual es la ultima pagina y bloquea
 * los botones para moverse a una pagina a la derecha. Y una vez este todo se muestra todo por pantalla.
 * 
 *
 * @return void no devuelve nada ya que lo muestra por pantalla
 */
function mostrarNumPag(){
    if(!isset($_GET["page"])){
        $numPagActual=1;
        $numArticles=5;
    }else{
        $numPagActual=intval($_GET["page"]);
        $numArticles=intval($_GET["article"]);
    }
    $text="";
    if($numPagActual==1){
        $text.='<li class="disabled">&laquo;&laquo;</li>';
        $text.='<li class="disabled">&laquo;</li>';
    }elseif($numPagActual!=1){
        $text.='<li class="enabled"><a href="../model/articles.php?page=1&article='.$_GET["article"].'">&laquo;&laquo;</a></li>';
        $text.='<li class="enabled"><a href="../model/articles.php?page='.($numPagActual-1).'&article='.$numArticles.'">&laquo;</a></li>';
    }
    for($i=1;$i<numPagina()+1;$i++){
        if($numPagActual==$i){
            $text.='<li class="active"><a href="../model/articles.php?page='.$i.'&article='.$numArticles.'">'.$i.'</a></li>';
        }else $text.='<li><a href="../model/articles.php?page='.$i.'&article='.$numArticles.'">'.$i.'</a></li>';
    }
    if($numPagActual==numPagina()){
        $text.='<li class="disabled">&raquo;</li>';
        $text.='<li class="disabled">&raquo;&raquo;</li>';
    }else {
        $text.='<li class="enabled"><a href="../model/articles.php?page='.($numPagActual+1).'&article='.$numArticles.'">&raquo;</a></li>';
        $text.='<li class="enabled"><a href="../model/articles.php?page='.numPagina().'&article='.$numArticles.'">&raquo;&raquo;</a></li>';
    }
    echo $text;
}


require '../vista/index.vista.php';

?>