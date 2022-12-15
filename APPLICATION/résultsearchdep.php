<?php include ('insertdépart.php'); 
?>
<!DOCTYPE html>
<html>
<head><script src="https://kit.fontawesome.com/ffd10f0970.js" crossorigin="anonymous"></script>
 	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta charset="utf-8">
	<title>Résultats de recherche</title>
</head>
<body>
<div class="row justify-content-center">
	<h2 >Résultats de votre recherche</h2>
</div>
	<table class="table table-striped" id="data_table"> 
 	 <thead>
  		<tr>
      <th>ID</th>
      <th>nature</th>
      <th>date d'envoi</th>
      <th>destinataire</th>
      <th>Objet</th>
      <th>fichier</th>
    	</tr>
     </thead>
      <tbody>
      	<?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
          <td><?php echo $row['IDD'] ?></td>
          <td><?php echo $row['nature'] ?></td>
          <td><?php echo $row['date_envoi'] ?></td>
          <td><?php echo $row['destinataire'] ?></td>
          <td><?php echo $row['objet'] ?></td>
          <td>
            <a href="upload/<?php echo $row['name']; ?>" target="_BLANK"><i class="fas fa-file-pdf"></i></a>
          </td>
        </tr>
    <?php } ?>
       </tbody>
   </table>
</body>
</html>