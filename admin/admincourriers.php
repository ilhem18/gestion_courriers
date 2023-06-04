<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "vous devez d'abord vous connectez !";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://kit.fontawesome.com/ffd10f0970.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
 	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<title>LISTE DES COURRIERS</title>
</head>
<body>

	<!--menu1-->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
					    <a class="nav-link" href="accueil_administrateur.php"><i class="fas fa-user"></i></a>	
					</li>
					<li class="nav-item ">
					    <a class="nav-link" href="..\admin\admincourriers.php">Courriers</a>
					 </li>
					<li class="nav-item">
					    <a class="nav-link" href="create_user.php">Ajouter utilisateur</a>
					</li>
					<li class="nav-item">
            			<a class="nav-link" href="..\admin\modeleimprimer.php">modèle à imprimer</a>
         			</li>
					<li class="nav-item">
					    <a class="nav-link" href="accueil_administrateur.php?logout='1'">Déconnexion</a>
					</li>
					    &nbsp;&nbsp;&nbsp;&nbsp;
					 <li class="nav-item">
					    <h3 class="nav-item text-secondary">Page d'administrateur</h3>	
					</li>
				</ul> 
			</div>		
		</nav>
	<!--/menu1-->

	<!--menu2-->
	<nav class="nav nav-pills nav-fill">
  		
    		<a class="nav-item nav-link" href="..\admin\courrierarri.php">Courriers arrivés</a>
  		
    		<a class="nav-item nav-link" href="..\admin\courrierdep.php">courriers départs</a>
  		
	</nav>
	
	<!--menu2-->
</body>
</html>