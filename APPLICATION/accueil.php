<?php 
include('functions.php');
if (!isResponsable()) {
	$_SESSION['msg'] = "vous devez d'abord vous connecter";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/ffd10f0970.js" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<title>Page d'accueil</title>
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
					    <a class="nav-link" href="accueil.php"><i class="fas fa-user"></i></a>	
					</li>
					<li class="nav-item ">
					    <a class="nav-link" href="rescourrier.php">Courriers</a>
					</li>
					<li class="nav-item">
            			<a class="nav-link" href="test.php">modèle à imprimer</a>
         			</li>
					<li class="nav-item">
					    <a class="nav-link" href="accueil.php?logout='1'">Déconnexion</a>
					</li>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<li class="nav-item">
					    <h3 class="nav-item text-secondary">Page du responsable</h3>	
					</li>
				</ul>     
			</div>
		</nav>
		<!--/menu-->

		

		<div class="p-3 mb-2 bg-light text-dark text-center">
			<strong>BIENVENUE:&nbsp;&nbsp;<?php echo $_SESSION['user']['username']; ?></strong>
			<small>
				<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['level']); ?>)</i> 
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