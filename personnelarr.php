<?php
include('functions.php');
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
	<script src="https://kit.fontawesome.com/ffd10f0970.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<title>Courrier arrivée</title>
	<style>
    .nav-item input{
      position: relative;
      float: right;
      margin-left: 400px;
      height: 50px;
      display: flex;
      cursor: pointer;
      padding: 10px 20px;
      background: #fff;
      border-radius: 30px;
      align-items: center;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      width: 600px;
      outline: none;
      border: none;
      font-size: 18px;
      font-weight: 500;
    }
  </style>
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
	  <a class="nav-item nav-link active" href="personnelarr.php">courriers arrivés</a>
	  <a class="nav-item nav-link" href="personneldép.php">courriers départs</a>
	</nav>

	<!--Recherche box-->
<nav class="navbar navbar-expand-lg navbar-light">
  <ul class="navbar-nav mr-auto">
  <li class="nav-item">
      <input id="search" type="text" onkeyup="myFunction()" placeholder="Rechercher un courrier">
  </li>
  </ul>
</nav>
<!--FIN Recherche box-->

   
     

<!--liste courrier-->
<div class="container">
	<div class="jumbotron">
		<div class="card">
			<h2>Courrier arrivé</h2>
		</div>
		<div class="card">
			<div class="card-body">
			<?php 
	        $db = mysqli_connect("localhost", "root", "", "gestioncourrier", "3308");
	        $results = $db->query("SELECT * FROM courrier_arrivé");
	        ?>
			<table id="data_table" class="table table-striped">
 			 <thead>
   				<tr>
					<th scope="col">ID</th>
					<th scope="col">nature</th>
					<th scope="col">date d'arrivée</th>
					<th scope="col">emetteur</th>
					<th scope="col">Objet</th>
                	<th scope="col">fichier</th>
					
				</tr>
			<?php foreach($results as $row) { ?>
				<tr>
					<td> <?php echo $row['IDA'] ?> </td>
					<td> <?php echo $row['nature'] ?> </td>
					<td> <?php echo $row['date_arrivée'] ?> </td>
					<td> <?php echo $row['emetteur'] ?> </td>
					<td> <?php echo $row['objet'] ?> </td>
	                <td>   
	                   <a href="upload/<?php echo $row['name']; ?>" target="_BLANK"><i class="fas fa-file-pdf"></i></a>
	                </td>
					
				</tr>
			<?php  } ?>
			</thead>
			</table>
			</div>
		</div>
	</div>
</div>

<!--recherche-->
<script type="text/javascript">
    $(document).ready(function(){
      $("#search_text").keyup(function(){
        var search = $(this).val();
        $.ajax({
          url: 'insertarrivé.php',
          method:'post',
          data:{query:search},
          succes:function(response){
            $("#data_table").html(response);
          }
        });
      });
    });
</script>

</body>
</html>