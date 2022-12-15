<?php 
session_start();
//connect to database 
$db = mysqli_connect("localhost", "root", "", "gestioncourrier", "3308");
//variable declaration 
$username="";
$nom="";
$prenom="";
$date_naissance="";
$date_embauche="";
//$level= "";
$num_tel="";
$errors= array();
//call the register() function if resgister_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}
//register user
function register(){
// call these variables with the global keyword to make them available in function
global $db, $errors,$nom,$prenom,$date_naissance,$date_embauche,$num_tel, $level, $username;
// receive all input values from the form 
$nom=e($_POST['nom']);
$prenom=e($_POST['prenom']);
$date_naissance=e($_POST['date_naissance']);
$date_embauche=e($_POST['date_embauche']);
$num_tel=e($_POST['num_tel']);
//$level=e($_POST['level']);
$username=e($_POST['username']);
$password_1=e($_POST['password_1']);
$password_2=e($_POST['password_2']);
//form validation: ensure that the form is correctly filled
	if (empty($nom)) {
		array_push($errors, "le nom d'utilisateur est requis");
	}
	if (empty($prenom)) {
		array_push($errors, "le prenom d'utilisateur est requis");
	}
	if (empty($date_naissance)) {
		array_push($errors, "date de naissance est requise");
	}
	if (empty($date_embauche)) {
		array_push($errors, "date d'embauche est requise");
	}
	if (empty($num_tel)) {
		array_push($errors, "numéro de téléphone est requis");
	}
	if (empty($username)) { 
		array_push($errors, "username est requis"); 
	} 
	if (empty($password_1)) { 
		array_push($errors, "mot de passe est requis"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "les deux mots de passe ne correspondent pas");
}
//register user if there are no errors in the form
if (count($errors) == 0) {
	$password = md5($password_1);//encrypt the password before saving in the database
if (isset($_POST['level'])) {
	$level = e($_POST['level']);
	$query = "INSERT INTO users (username, level, password, nom, prenom, date_naissance, date_embauche, num_tel) VALUES('$username', '$level', '$password', '$nom', '$prenom', '$date_naissance', '$date_embauche', '$num_tel')";
	mysqli_query($db, $query);
	$_SESSION['success']  = "Nouvel utilisateur créé avec succès!!";
	header('location: ..\admin\accueil_administrateur.php');
	
	
}else{
	$query = "INSERT INTO users (username,level, password, nom, prenom, date_naissance, date_embauche, num_tel) VALUES('$username','user', '$password', '$nom', '$prenom', '$date_naissance', '$date_embauche', '$num_tel')";
	mysqli_query($db, $query);

// get id of the created user
$logged_in_user_id = mysqli_insert_id($db);

$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
$_SESSION['success']  = "vous êtes connectés";
			header('location: ..\admin\accueil_administrateur.php');				
}
}
}
// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}
// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}
// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "nom d'utilisateur est requis");
	}
	if (empty($password)) {
		array_push($errors, "mot de passe est requis");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['level'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "vous êtes connectés";
				header('location: admin/accueil_administrateur.php');		  
			}elseif ($logged_in_user['level'] == 'responsable') {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "vous êtes connectés";
				header('location: accueil.php');
			}
			else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "vous êtes connectés";
				header('location: personnelhome.php');
			}
		}else {
			array_push($errors, "nom d'utilisateur/mot de passe incorrect");
		}
	}
}
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['level'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}
function isResponsable()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['level'] == 'responsable') {
		return true;
	}else{
		return false;
	}
}
?>