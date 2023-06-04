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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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
<iframe  style="height: 700px; width: 100%" id="pdf" name="pdf" src="..\modelelettre1.pdf"></iframe>
<br>
 <button class="btn btn-light btn-lg btn-block" onclick="printt()">imprimer/enregistrer</button>

 <script type="text/javascript">
   function printt()
{
  var pdfFrame = window.frames["pdf"];
  pdfFrame.focus();
  pdfFrame.print();
}
 </script>
  
  </body>
</html>