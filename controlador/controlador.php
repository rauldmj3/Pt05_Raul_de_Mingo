<?php 
//Raúl de Mingo Jiménez

/**
 * La funcion realiza la conexion a la base de datos si no funciona muestra un alert por pantalla.
 *
 * @return PDO
 */
function conDB(){
    $con= new PDO('mysql:host=localhost;dbname=pt04_raul_de_mingo', 'root', '');
    if(empty($con)) echo "<script>alert('No s'ha pogut connectar a la BD')</script>";
    return $con;
}

/**
 * La funcion realiza una sentencia SQL a la base de datos para devolver el total de los articulos que hay en la base de datos. Y como devuelve un array
 * se hace un count para saber el total que hay.
 *
 * @return int es el total de paginas que hay que mostrar por pantalla.
 */
function numPagina(){
    $con = conDB();
    $stt= $con->prepare('SELECT * FROM articles');
    $stt->execute();
    $articles = $stt->fetchAll();
    if(empty($articles)) $articles = 1;
    $con=null;
    $totalArticles= count($articles);
    $numArtPag=5;
    if(isset($_GET["article"])){
        $numArtPag=intval($_GET["article"]);
    }
   
    return ceil($totalArticles/$numArtPag);
}

function validar($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkPass($email,$pass){
    
    $con= conDB();
    $stt=$con->prepare("SELECT password FROM users WHERE email = :email");
    $stt->execute([":email"=>$email]);
    $realPass=$stt->fetchAll();
    if(password_verify($pass,$realPass[0]["password"])) return true;
    else return false;
}
function encriptar($pass){
    $hash=password_hash($pass,PASSWORD_BCRYPT);
    return $hash;
}


  

?>