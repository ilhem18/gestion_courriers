<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
* { margin: 0px; padding: 0px; }
body {
	font-size: 120%;
	background: #F8F8FF;
}
.login-box {
	width: 380px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	color: #000;
	background: #ffe4c4;
	padding: 50px;
	border-radius: 20px;
}
.login-box h2{
	float: left;
	font-size: 40px;
	border-bottom: 6px solid rgb(0,33,71);
	margin-bottom: 50px;
	padding: 13px 0;
}
.textbox{
	width: 100%;
	overflow: hidden;
	font-size: 20px;
	padding: 8px 0;
	margin: 8px 0;
	border-bottom: 1px solid rgb(0,33,71);
}
.textbox input{
	border: none;
	outline: none;
	background-color: transparent;
	color: #000;
	font-size: 18px;
	width: 80%;
	float: left;
	margin: 0 10px;
}
.btn {
	width: 100%;
	background-color: transparent;
	border: 2px solid rgb(0,33,71);
	color: #000;
	padding: 5px;
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
	<title>Connexion</title>
	<meta charset="utf-8">
</head>
<body>
	<div class="login-box">
		<h2>Connexion</h2>
	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="textbox">
			<label>Nom d'utilisateur</label>
			<input type="text" name="username" >
		</div>
		<div class="textbox">
			<label>Mot de passe</label>
			<input type="password" name="password">
		</div>
		
			<button type="submit" class="btn" name="login_btn">Login</button>
		
		<!--<p>
			créer un compte <a href="register.php">inscription</a>
		</p>-->
	</form>
	</div>
</body>
</html>