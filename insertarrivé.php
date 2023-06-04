<?php
		$IDA= 0;
		$nature= "";
		$emetteur="";
		$objet= "";
		$date_arrivee= "";
		$edit_state=false;
	$db = mysqli_connect("localhost", "root", "", "gestioncourrier");

//ajouter données
	if(isset($_POST['save'])){ 
	$nature= $_POST['nature'];
	$emetteur=$_POST['emetteur'];
	$objet= $_POST['objet'];
	$date_arrivee= $_POST['date_arrivee'];
		// name of the uploaded file
	    $filename = $_FILES['myfile']['name'];

	    // destination of the file on the server
	    $destination = 'upload/' . $filename;

	    // get the file extension
	    $extension = pathinfo($filename, PATHINFO_EXTENSION);

	    // the physical file on a temporary uploads directory on the server
	    $file = $_FILES['myfile']['tmp_name'];
	    $size = $_FILES['myfile']['size'];

	    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
	        $query="INSERT INTO courrier_arrivé(nature,emetteur,objet,date_arrivee) VALUES ('$nature', '$emetteur', '$objet', '$date_arrivee')";		
		$run=mysqli_query($db,$query);
		if($run){
		echo'<script> alert("courrier ajouté");</script>';
 		header('location: courrierarr.php');
		}
		else{
		echo '<script> alert("courrier non ajouté");</script>';
		}
	    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
	        echo "File too large!";
	    } else {
	        // move the uploaded (temporary) file to the specified destination
	        if (move_uploaded_file($file, $destination)) {
	            $query="INSERT INTO courrier_arrivé(nature,emetteur,objet,date_arrivee,name) VALUES ('$nature', '$emetteur', '$objet', '$date_arrivee','$filename')";		
		$run=mysqli_query($db,$query);
		if($run){
		echo'<script> alert("courrier ajouté");</script>';
 		header('location: courrierarr.php');
		}
		else{
		echo '<script> alert("courrier non ajouté");</script>';
		}
	}
}
} 

//read pdf file
if (isset($_GET['file_id'])) {

    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM courrier_arrivé WHERE name=$id";
    $results = mysqli_query($db, $sql);

    $file = mysqli_fetch_assoc($results);
    $filepath = 'upload/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('upload/' . $file['name']));
        readfile('upload/' . $file['name']);

        /*Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;*/
    }

}

//modifier les données
if (isset($_POST['update'])) {

		$nature= mysqli_real_escape_string($db,$_POST['nature']);
		$emetteur= mysqli_real_escape_string($db,$_POST['emetteur']);
		$objet= mysqli_real_escape_string($db,$_POST['objet']);
		$date_arrivee= mysqli_real_escape_string($db,$_POST['date_arrivee']);
		$IDA = mysqli_real_escape_string($db,$_POST['IDA']);
		$filename =mysqli_real_escape_string($db, $_FILES['myfile']['name']);
		 // destination of the file on the server
	    $destination = 'upload/' . $filename;
	    // get the file extension
	    $extension = pathinfo($filename, PATHINFO_EXTENSION);

	    // the physical file on a temporary uploads directory on the server
	    $file = $_FILES['myfile']['tmp_name'];
	    $size = $_FILES['myfile']['size'];
	     if ($_FILES['myfile']['name'] == NULL) {
	    mysqli_query($db,"UPDATE courrier_arrivé SET nature='$nature', emetteur='$emetteur', objet='$objet', date_arrivee='$date_arrivee' WHERE IDA=$IDA");
		
		header('location: courrierarr.php');
	    }
	    elseif (!in_array($extension, ['zip', 'pdf', 'docx'])) {
	        echo "You file extension must be .zip, .pdf or .docx";
	    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
	        echo "File too large!";
	    } else {
	        // move the uploaded (temporary) file to the specified destination
	        if (move_uploaded_file($file, $destination)) {

		mysqli_query($db,"UPDATE courrier_arrivé SET nature='$nature', emetteur='$emetteur', objet='$objet', date_arrivee='$date_arrivee',name='$filename' WHERE IDA=$IDA");
		
			header('location: courrierarr.php');
}		
}
}

//supprimer les données
	if (isset($_POST['del'])) {
		$IDA=$_POST['delete_IDA'];
		$res=mysqli_query($db,"DELETE FROM courrier_arrivé WHERE IDA='$IDA'");
		if ($res) {
			echo '<script> alert("courrier supprimé");</script>';
			header('location: courrierarr.php');
		}
		else{
			echo '<script> alert("courrier non supprimé");</script>';
		}
		
	}

//recherche
	if (isset($_POST['recherche'])) {
  $search=$_POST['search'];
  $stmt=$db->prepare("SELECT * FROM courrier_arrivé WHERE emetteur LIKE CONCAT('%',?,'%') OR objet LIKE CONCAT('%',?,'%') OR date_arrivée LIKE CONCAT('%',?,'%') OR nature LIKE CONCAT('%',?,'%')");
  $stmt->bind_param("ssss", $search,$search,$search,$search);
  //$result=mysqli_query($conn,$stmt);
 
  $stmt->execute();
  $results=$stmt->get_result(); 
  //header('recherchedep.php');
  
}
?>