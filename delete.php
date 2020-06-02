<?php 

include_once "apps/db.php";
include_once "apps/function.php";

if ( isset($_GET['id']) ) {
	
	$id = $_GET['id'];

}

 $sql = "DELETE FROM studentss WHERE id='$id'";
 $data = $connection -> query($sql);

 header('location: add students.php')


 ?>