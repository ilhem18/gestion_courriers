<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://kit.fontawesome.com/ffd10f0970.js" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title>Ajout d'un utilisateur</title>
	<style type="text/css">
* { margin: 0px; padding: 0px; }
body {
	font-size: 120%;
	background: #F8F8FF;
}
.header {
	width: 40%;
	margin: 50px auto 0px;
	color: white;
	background: #5AC5A4;
	text-align: center;
	border: 1px solid #B0C4DE;
	border-bottom: none;
	border-radius: 10px 10px 0px 0px;
	padding: 20px;
}
form, .content {
	width: 40%;
	margin: 0px auto;
	padding: 20px;
	border: 1px solid #B0C4DE;
	background: white;
	border-radius: 0px 0px 10px 10px;
}
.input-group {
	margin: 10px 0px 10px 0px;
}
.input-group label {
	display: block;
	text-align: left;
	margin: 3px;
}
.input-group input {
	height: 30px;
	width: 93%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
#level {
	height: 40px;
	width: 98%;
	padding: 5px 10px;
	background: white;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
.btn {
	padding: 10px;
	font-size: 15px;
	color: white;
	background: #5AC5A4;
	border: none;
	border-radius: 5px;
}
.error {
	width: 92%; 
	margin: 0px auto; 
	padding: 10px; 
	border: 1px solid #a94442; 
	color: #a94442; 
	background: #f2dede; 
	border-radius: 5px; 
	text-align: left;
}
.success {
	color: #3c763d; 
	background: #dff0d8; 
	border: 1px solid #3c763d;
	margin-bottom: 20px;
}
.profile_info img {
	display: inline-block; 
	width: 50px; 
	height: 50px; 
	margin: 5px;
	float: left;
}
.profile_info div {
	display: inline-block; 
	margin: 5px;
}
.profile_info:after {
	content: "";
	display: block;
	clear: both;
}
</style>
</head>
<body>

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
	<div class="header">
		<h2>Ajouter un utilisateur</h2>
	</div>
<form method="post" action="create_user.php">

	<?php echo display_error(); ?>

	<div class="input-group">
		<label>Nom</label>
		<input type="text" name="nom" value="<?php echo $nom; ?>">
	</div>
	<div class="input-group">
		<label>Prénom</label>
		<input type="text" name="prenom" value="<?php echo $prenom; ?>">
	</div>
	<div class="input-group">
		<label>date de naissance</label>
		<input type="date" name="date_naissance" value="<?php echo $date_naissance; ?>">
	</div>
	<div class="input-group">
		<label>date d'embauche</label>
		<input type="date" name="date_embauche" value="<?php echo $date_embauche; ?>">
	</div>
	<div class="input-group">
		<label>numéro de téléphone</label>
		<input type="text" name="num_tel" value="<?php echo $num_tel; ?>">
	</div>
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>type d'utilisateur</label>
			<select name="level" id="level" >
				<option value=""></option>
				<option value="responsable">Responsable du courrier</option>
				<option value="user">personnel</option>
			</select>
	</div>
	<div class="input-group">
		<label>mot de passe</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirmer mot de passe</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn"> ajouter un utilisateur</button>
	</div>
	</form>
</body>
</html>