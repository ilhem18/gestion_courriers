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
					    <a class="nav-link" href="..\admin\create_user.php">Ajouter utilisateur</a>
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
  		
    		<a class="nav-item nav-link active" href="..\admin\courrierarri.php">Courriers arrivés</a>
  		
    		<a class="nav-item nav-link" href="..\admin\courrierdep.php">courriers départs</a>
	</nav>
	
	<!--menu2-->



  <!--Recherche box-->
<nav class="navbar navbar-expand-lg navbar-light">
  <ul class="navbar-nav mr-auto">
  <li class="nav-item">
      <input id="search" type="text" onkeyup="myFunction()" placeholder="Rechercher un courrier">
  </li>
  </ul>
</nav>
<!--FIN Recherche box-->



	<!--bodycourrierarrivé-->
	<!-- ADD DATA -->
<div class="modal fade" id="ajoutcourrierdepmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">L'ajout d'un courrier arrivé</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="insertarr.php" enctype="multipart/form-data">
      <div class="modal-body">
      <input type="hidden" name="IDA">
        <div class="form-group">
          <?php
          $nature = '<select class="form-control" name="nature" id="choix">
            <option value="lettre">lettre</option>
            <option value="mail">mail</option>
            <option value="télécopie">télécopie</option>
                  </select>';
        	 if(isset($_POST['nature']))
         		$nature = str_replace('value="'.$_POST['nature'].'"', 'value="'.$_POST['nature'].'" selected="selected"', $nature);
          ?>
        <label for="nature">nature</label>
          <?php echo $nature; ?>
        </div>
        <div class="form-group">
          <label>date d'arrivée</label>
           <input type="date" class="form-control" name="date_arrivee" >
        </div>
        <div class="form-group">
          <label>émetteur</label>
           <input type="text" class="form-control" name="emetteur" >
        </div>
        <div class="form-group">
          <label>objet</label>
           <input type="text" class="form-control" name="objet">
        </div>
        <div class="form-group">
        <label>fichier</label><br>
          <input type="file" name="myfile"> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Enregistrer</button>
      </div>
    </form> 
    </div>
  </div>
</div>


<!--###################################################################################################################-->

<!-- EDIT DATA -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ExampleModalLabel">Modifier un courrier arrivé</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="insertarr.php" enctype="multipart/form-data">
      <div class="modal-body">
      <input type="hidden" name="IDA" id="IDA">
        <div class="form-group">
          <?php
          $nature = '<select class="form-control" name="nature" id="choix">
            <option value="lettre">lettre</option>
            <option value="mail">mail</option>
            <option value="télécopie">télécopie</option>
                  </select>';
        	 if(isset($_POST['nature']))
         		$nature = str_replace('value="'.$_POST['nature'].'"', 'value="'.$_POST['nature'].'" selected="selected"', $nature);
          ?>
        <label for="nature">nature</label>
          <?php echo $nature; ?>
        </div>
        <div class="form-group">
          <label>date d'arrivée</label>
           <input type="text" class="form-control" name="date_arrivee" id="date_arrivee" >
        </div>
        <div class="form-group">
          <label>emetteur</label>
           <input type="text" class="form-control" name="emetteur" id="emetteur">
        </div>
        <div class="form-group">
          <label>objet</label>
           <input type="text" class="form-control" name="objet" id="objet">
        </div>
        <div class="form-group">
        <label>fichier</label><br>
          <input type="file" name="myfile" id="myfile"> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Enregistrer les modifications</button>
      </div>
    </form> 
    </div>
  </div>
</div>
<!--######################################################################################################-->




<!--###################################################################################################################-->

<!-- DELETE DATA -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ExampleModalLabel">Supprimer le courrier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="insertarr.php">
      <div class="modal-body">
      <input type="hidden" name="delete_IDA" id="delete_IDA">
      <h4>Voulez-vous vraiment supprimer ce courrier ?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
        <button type="submit" name="del" class="btn btn-primary">Oui</button>
      </div>
    </form> 
    </div>
  </div>
</div>
<!--######################################################################################################-->

<!--LISTE DES COURRIERS-->
	<div class="container">
		<div class="jumbotron">
			<div class="card">
				<h2>Courrier arrivé</h2>
			</div>
			<div class="card">
				<div class="card-body">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutcourrierdepmodal">
  					ajouter un courrier
				</button>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
				<?php 
        $db = mysqli_connect("localhost", "root", "", "gestioncourrier");
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
					      <th scope="col" colspan="2">Action</th>
					    </tr>
					    <?php foreach($results as $row) { ?>
					    <tr>
					      <td> <?php echo $row['IDA'] ?> </td>
					      <td> <?php echo $row['nature'] ?> </td>
					      <td> <?php echo $row['date_arrivee'] ?> </td>
					      <td> <?php echo $row['emetteur'] ?> </td>
					      <td> <?php echo $row['objet'] ?> </td>
                <td>   
                  <a href="../upload/<?php echo $row['name']; ?>" target="_BLANK"><i class="fas fa-file-pdf"></i></a>
                </td>
					      <td>
					        <button type="button" class="editbtn"><i class="fas fa-pen" title="modifier"></i></button>
					      </td>
                <td>
                  <button type="button" class="deletebtn"><i class="far fa-trash-alt" title="supprimer"></i></button>
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
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("data_table");
  tr = table.getElementsByTagName("tr");
  
  // Loop through all table rows, and hide those that don't match the search query
  for (i = 0; i < tr.length; i++) {
    var displayRow = false; // Flag to determine if row should be displayed
    
    // Loop through all table cells in the row
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      txtValue = td[j].textContent || td[j].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        displayRow = true;
        break; // Break the inner loop if a match is found in any column
      }
    }
    
    // Set the display style based on the flag
    if (displayRow) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
</script>


<!--supprimer-->
<script type="text/javascript">
  $(document).ready(function(){
    $('.deletebtn').on('click',function(){

      $('#deletemodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function(){
      return $(this).text();
      }).get();

      console.log(data);
      $('#delete_IDA').val(data[0]);
      
    });
  });
</script>

<!--modifier-->
<script type="text/javascript">
	$(document).ready(function(){
		$('.editbtn').on('click',function(){

			$('#editmodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function(){
        return $(this).text();
      }).get();

      console.log(data);
      $('#IDA').val(data[0]);
      $('#nature').val(data[1]);
      $('#date_arrivée').val(data[2]);
      $('#emetteur').val(data[3]);
      $('#objet').val(data[4]);
      $('#myfile').val(data[5]);

		});
	});
</script>
	<!--/bodycourrierarrivé-->
</body>
</html>