<!DOCTYPE html>
<html lang="en">
<!-- Raúl de Mingo Jiménez -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">  
	<link rel="stylesheet" href="../estils.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<title>Paginació</title>
	<script>
		function canviarNumArt(){
			let codigo = event.which || event.keyCode;	
			if(codigo === 13){
				let num=document.getElementById("numArticle").value;
				if(!isNaN(num)) {
					let [link,]=location.href.split("&");
					location.href=link+"../model/index.php&article="+num;
				};
			}
		}
	</script>
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
		<div class="navBar"><h1><?php $_SESSION["email"]; ?></h1></div>
		<div class="navBar"><a class="navbar-brand" href="../model/tancarSessio.php">Tancar Sessió</a></div>
		<?php 
			endif;
		?>
	</nav>
	<div class="contenidor">
		<h1>Articles</h1>
		<label>Numero de articles per veure: <input id="numArticle" type="numeric" value="5" name="numArticles" onkeydown="canviarNumArt()"></label>
		<section class="articles">
			<ul>
				<?php 
					mostrar();
				?>
			</ul>
		</section>

		<section class="paginacio">
			<ul>
				<?php
					
					mostrarNumPag();
					
				?>
			</ul>
		</section>
	</div>
</body>
</html>