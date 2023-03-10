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
					    <a class="nav-link" href="..\admin\create_user.php">Ajouter utilisateur</a>
					</li>
					<li class="nav-item">
            			<a class="nav-link" href="..\admin\modeleimprimer.php">mod??le ?? imprimer</a>
         			</li>
					<li class="nav-item">
					    <a class="nav-link" href="accueil_administrateur.php?logout='1'">D??connexion</a>
					</li>
					    &nbsp;&nbsp;&nbsp;&nbsp;
					 <li class="nav-item">
					    <h3 class="nav-item text-secondary">Page d'administrateur</h3>	
					</li>
				</ul>     
			</div>
			<!--form de recherche-->
			<form class="form-inline" action="..\r??sultsearcharr.php" method="post">
	          	<input class="form-control mr-sm-2" type="search" name="search" id="search_text" placeholder="Recherche" aria-label="Recherche">
	         	<button class="btn btn-outline-success my-2 my-sm-0" name="recherche" type="submit">Recherche</button>
	    	</form>
		</nav>
	<!--/menu1-->

	<!--menu2-->
	<nav class="nav nav-pills nav-fill">
  		
    		<a class="nav-item nav-link active" href="..\admin\courrierarri.php">Courriers arriv??s</a>
  		
    		<a class="nav-item nav-link" href="..\admin\courrierdep.php">courriers d??parts</a>
  		
	</nav>
	
	<!--menu2-->

	<!--bodycourrierarriv??-->
	<!-- ADD DATA -->
<div class="modal fade" id="ajoutcourrierdepmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">L'ajout d'un courrier arriv??</h5>
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
            <option value="t??l??copie">t??l??copie</option>
                  </select>';
        	 if(isset($_POST['nature']))
         		$nature = str_replace('value="'.$_POST['nature'].'"', 'value="'.$_POST['nature'].'" selected="selected"', $nature);
          ?>
        <label for="nature">nature</label>
          <?php echo $nature; ?>
        </div>
        <div class="form-group">
          <label>date d'arriv??e</label>
           <input type="date" class="form-control" name="date_arriv??e" >
        </div>
        <div class="form-group">
          <label>??metteur</label>
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
        <h5 class="modal-title" id="ExampleModalLabel">Modifier un courrier arriv??</h5>
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
            <option value="t??l??copie">t??l??copie</option>
                  </select>';
        	 if(isset($_POST['nature']))
         		$nature = str_replace('value="'.$_POST['nature'].'"', 'value="'.$_POST['nature'].'" selected="selected"', $nature);
          ?>
        <label for="nature">nature</label>
          <?php echo $nature; ?>
        </div>
        <div class="form-group">
          <label>date d'arriv??e</label>
           <input type="text" class="form-control" name="date_arriv??e" id="date_arriv??e" >
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
				<h2>Courrier arriv??</h2>
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
        $db = mysqli_connect("localhost", "root", "", "gestioncourrier", "3308");
        $results = $db->query("SELECT * FROM courrier_arriv??");
        ?>
				<table id="data_table" class="table table-striped">
 			 		<thead>
   						<tr>
					      <th scope="col">ID</th>
					      <th scope="col">nature</th>
					      <th scope="col">date d'arriv??e</th>
					      <th scope="col">emetteur</th>
					      <th scope="col">Objet</th>
                <th scope="col">fichier</th>
					      <th scope="col" colspan="2">Action</th>
					    </tr>
					    <?php foreach($results as $row) { ?>
					    <tr>
					      <td> <?php echo $row['IDA'] ?> </td>
					      <td> <?php echo $row['nature'] ?> </td>
					      <td> <?php echo $row['date_arriv??e'] ?> </td>
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
<script type="text/javascript">
    $(document).ready(function(){
      $("#search_text").keyup(function(){
        var search = $(this).val();
        $.ajax({
          url: 'insertarr.php',
          method:'post',
          data:{query:search},
          succes:function(response){
            $("#data_table").html(response);
          }
        });
      });
    });
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
      $('#date_arriv??e').val(data[2]);
      $('#emetteur').val(data[3]);
      $('#objet').val(data[4]);
      $('#myfile').val(data[5]);

		});
	});
</script>
	<!--/bodycourrierarriv??-->
</body>
</html>