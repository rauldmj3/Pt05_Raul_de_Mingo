<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">  
	<link rel="stylesheet" href="../estils.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	
    <title>Inserir</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="navBar"><a class="navbar-brand" href="../model/index.php?page=1&article=5">Articles</a></div>
		<div class="navBar"><a class="navbar-brand" href="../model/articles.php?page=1&article=5">Mis articles</a></div>
		<?php 
			session_start();
			if(!isset($_SESSION['loggedin'])):
		?>
		<div class="login">
			<div class="navBar"><a class="navbar-brand" href="../model/login.php">Login</a></div>
			<div class="navBar"><a class="navbar-brand" href="../model/register.php">Register</a></div>
		</div>
		<?php 
			else:
				
		?>
		<div class="navBar"><a class="navbar-brand" href="../model/inserir.php">Inserir article</a></div>
		<div class="navBar"><h1><?php $_SESSION["email"]; ?></h1></div>
		<div class="navBar"><a class="navbar-brand" href="../model/tancarSessio.php">Tancar Sessió</a></div>
		<?php 
			endif;
		?>
	</nav>
    <h1>Inserir articles</h1>
    <form action="../model/inserir.php" method="post">
        <label>Article: <input type="text" name="article" size="100"></label><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>