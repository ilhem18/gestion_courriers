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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/ffd10f0970.js" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<title>Accueil</title>
</head>
<body>
	
	<div class="content">

		<!-- logged in user information -->
		<div class="profile_info">

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
				<!--menu-->
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
				<!--/menu-->

				&nbsp;&nbsp;&nbsp;&nbsp;
			<div class="p-3 mb-2 bg-light text-dark text-center">
				<strong >BIENVENUE &nbsp; <?php echo $_SESSION['user']['username']; ?></strong>
				<small>
					<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['level']); ?>)</i> 
					<br> 
				</small>
			</div>
				<?php endif ?>

			<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h4>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h4>
			</div>
		<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>