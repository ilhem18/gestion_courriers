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
	background: #F8F8FF;
}
.inscription-box {
	text-align: center;
	width: 80%;
	margin-top: 30px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	color: #000;
	background: #ffe4c4;
	padding: 50px;
	border-radius: 20px;
}
.inscription-box h2{
	font-size: 40px;
	border-bottom: 6px solid rgb(0,33,71);
	margin-bottom: 50px;
	padding: 13px 0;
}
.register-form {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 10px;
}
.textbox{
	display: flex;
  	flex-direction: column;
	width: 100%;
	overflow: hidden;
	font-size: 20px;
	padding: 8px 0;
	margin: 8px 0;
	border-bottom: 1px solid rgb(0,33,71);
}
.textbox input{
	text-align: center;
	border: none;
	outline: none;
	background-color: transparent;
	color: #000;
	font-size: 18px;
	width: 80%;
	float: left;
	margin: 0 10px;
}
#level{
	background-color:transparent;
	color: #000;
}
.btn {
	width: 50%;
	background-color: transparent;
	border: 2px solid rgb(0,33,71);
	color: #000;
	padding: 15px;
	font-size: 18px;
	cursor: pointer;
	border-radius: 30px;
	margin: 20px 0;
}
.btn:hover{
	background-color: rgb(0,33,71);
	color: #fff;
	transition: 0.5;
}
.btn:active{
	background-color: #fff;
	color: rgb(0,33,71);
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
	<div class="inscription-box">
		<h2>Ajouter un utilisateur</h2>
	<form method="post" action="create_user.php">

			<?php echo display_error(); ?>
	<div class="register-form">
		<div class="textbox">
			<label>Nom</label>
			<input type="text" name="nom" value="<?php echo $nom; ?>">
		</div>
		<div class="textbox">
			<label>Prénom</label>
			<input type="text" name="prenom" value="<?php echo $prenom; ?>">
		</div>
		<div class="textbox">
			<label>date de naissance</label>
			<input type="date" name="date_naissance" value="<?php echo $date_naissance; ?>">
		</div>
		<div class="textbox">
			<label>date d'embauche</label>
			<input type="date" name="date_embauche" value="<?php echo $date_embauche; ?>">
		</div>
		<div class="textbox">
			<label>numéro de téléphone</label>
			<input type="text" name="num_tel" value="<?php echo $num_tel; ?>">
		</div>
		<div class="textbox">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="textbox">
			<label>type d'utilisateur</label>
			<select name="level" id="level" >
				<option value=""></option>
				<option value="responsable">Responsable du courrier</option>
				<option value="user">personnel</option>
			</select>
		</div>
		<div class="textbox">
			<label>mot de passe</label>
			<input type="password" name="password_1">
		</div>
		<div class="textbox">
			<label>Confirmer mot de passe</label>
			<input type="password" name="password_2">
		</div>
	</div>
		<button type="submit" class="btn" name="register_btn"> ajouter un utilisateur</button>
	</form>
	</div>
</body>
</html>