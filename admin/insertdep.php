<?php
		$IDD= 0;
		$nature= "";
		$destinataire="";
		$objet= "";
		$date_envoi= "";
		$edit_state=false;
	$db = mysqli_connect("localhost", "root", "", "gestioncourrier", "3308");

//ajouter données
	if(isset($_POST['save'])){ 
	$nature= $_POST['nature'];
	$destinataire=$_POST['destinataire'];
	$objet= $_POST['objet'];
	$date_envoi= $_POST['date_envoi'];
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
	        $query="INSERT INTO courrier_départ(nature,destinataire,objet,date_envoi) VALUES ('$nature', '$destinataire', '$objet', '$date_envoi')";		
		$run=mysqli_query($db,$query);
		if($run){
		echo'<script> alert("courrier ajouté");</script>';
 		header('location: ..\admin\courrierdep.php');
		}
		else{
		echo '<script> alert("courrier non ajouté");</script>';
		}
	    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
	        echo "File too large!";
	    } else {
	        // move the uploaded (temporary) file to the specified destination
	        if (move_uploaded_file($file, $destination)) {
	            $query="INSERT INTO courrier_départ(nature,destinataire,objet,date_envoi,name) VALUES ('$nature', '$destinataire', '$objet', '$date_envoi','$filename')";		
		$run=mysqli_query($db,$query);
		if($run){
		echo'<script> alert("courrier ajouté");</script>';
 		header('location: ..\admin\courrierdep.php');
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
    $sql = "SELECT * FROM courrier_départ WHERE name=$id";
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
		$destinataire= mysqli_real_escape_string($db,$_POST['destinataire']);
		$objet= mysqli_real_escape_string($db,$_POST['objet']);
		$date_envoi= mysqli_real_escape_string($db,$_POST['date_envoi']);
		$IDD = mysqli_real_escape_string($db,$_POST['IDD']);
		$filename =mysqli_real_escape_string($db, $_FILES['myfile']['name']);
		 // destination of the file on the server
	    $destination = 'upload/' . $filename;
	    // get the file extension
	    $extension = pathinfo($filename, PATHINFO_EXTENSION);

	    // the physical file on a temporary uploads directory on the server
	    $file = $_FILES['myfile']['tmp_name'];
	    $size = $_FILES['myfile']['size'];
	    if ($_FILES['myfile']['name'] == NULL) {
	    mysqli_query($db,"UPDATE courrier_départ SET nature='$nature', destinataire='$destinataire', objet='$objet', date_envoi='$date_envoi' WHERE IDD=$IDD");
		
			header('location: ..\admin\courrierdep.php');
	    }
	    
	    elseif (!in_array($extension, ['zip', 'pdf', 'docx'])) {
	        echo "You file extension must be .zip, .pdf or .docx";
	    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
	        echo "File too large!";
	    } else {
	        // move the uploaded (temporary) file to the specified destination
	        if (move_uploaded_file($file, $destination)) {

		mysqli_query($db,"UPDATE courrier_départ SET nature='$nature', destinataire='$destinataire', objet='$objet', date_envoi='$date_envoi',name='$filename' WHERE IDD=$IDD");
		
			header('location: ..\admin\courrierdep.php');
}		
}
}

//supprimer les données
	if (isset($_POST['del'])) {
		$IDD=$_POST['delete_IDD'];
		$res=mysqli_query($db,"DELETE FROM courrier_départ WHERE IDD='$IDD'");
		if ($res) {
			echo '<script> alert("courrier supprimé");</script>';
			header('location: courrierdep.php');
		}
		else{
			echo '<script> alert("courrier non supprimé");</script>';
		}
		
	}

/*
	if (isset($_POST['recherche'])) {
  $search=$_POST['search'];
  $stmt=$db->prepare("SELECT * FROM courrier_départ WHERE destinataire LIKE CONCAT('%',?,'%') OR objet LIKE CONCAT('%',?,'%') OR date_envoi LIKE CONCAT('%',?,'%') OR nature LIKE CONCAT('%',?,'%')");
  $stmt->bind_param("ssss", $search,$search,$search,$search);
  //$result=mysqli_query($conn,$stmt);
 
  $stmt->execute();
  $results=$stmt->get_result(); 
  //header('recherchedep.php');
  
}*/
    

?>