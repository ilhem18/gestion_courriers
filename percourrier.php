<?php 
include ('functions.php');

if (!isLoggedIn()) {
	$_SESSION['msg'] = "vous devez d'abord vous connecter";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location:login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/ffd10f0970.js" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<title>LISTE DES COURRIERS</title>
</head>
<body>

	<!--menu-->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
					    <a class="nav-link" href="personnelhome.php"><i class="fas fa-user"></i></a>	
					</li>
					<li class="nav-item ">
					    <a class="nav-link" href="percourrier.php">Courriers</a>
					</li>
					<li class="nav-item">
            			<a class="nav-link" href="test.php">modèle à imprimer</a>
         			</li>
					<li class="nav-item">
					    <a class="nav-link" href="personnelhome.php?logout='1'">Déconnexion</a>
					</li>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<li class="nav-item">
					    <h3 class="nav-item text-secondary">Page du personnel</h3>	
					</li>
				</ul>     
			</div>
		</nav>
	<!--/menu-->

	<!--menu2-->
	<nav class="nav nav-pills nav-fill">
	  <a class="nav-item nav-link" href="personnelarr.php">courriers arrivés</a>
	  <a class="nav-item nav-link" href="personneldép.php">courriers départs</a>
	</nav>

</body>
</html>