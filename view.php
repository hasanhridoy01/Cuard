
<?php include_once "apps/db.php"; ?>
<?php include_once "apps/function.php"; ?>


<!DOCTYPE html>
<html>
<head>
	<title>Add Students</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.css">
</head>
<body>
	<?php 
       
       if ( isset($_GET['id']) ) {
       	
       	  $id = $_GET['id'];

       }
       
       $sql = "SELECT * FROM studentss WHERE id='$id'";
       $data = $connection ->query($sql);
       $single_data = $data -> fetch_assoc();

	 ?>
	 <div class="container">
	 	<div class="row">
	 		<div class="card shadow-lg mt-5 mx-auto">
	 			<div class="card-header"><h2 style="text-align: center;">Your Profile</h2>
                 <a href="Add students.php" class="btn btn-outline-info mt-2">All Students</a>
	 			</div>
	 			<div class="card-body">
	 				<img src="photo/<?php echo $single_data['photo'] ?>" alt="" style="width: 290px; margin: 10px auto; padding: 40px; border: 5px solid gray;">
	 				<table class="table table-striped">
	 					<tr>
	 						<td>name</td>
	 						<td><?php echo $single_data['name'] ?></td>
	 					</tr>
	 					<tr>
	 						<td>email</td>
	 						<td><?php echo $single_data['email'] ?></td>
	 					</tr>
	 					<tr>
	 						<td>cell</td>
	 						<td><?php echo $single_data['cell'] ?></td>
	 					</tr>
	 					<tr>
	 						<td>location</td>
	 						<td><?php echo $single_data['location'] ?></td>
	 					</tr>
	 					<tr>
	 						<td>gender</td>
	 						<td><?php echo $single_data['gender'] ?></td>
	 					</tr>
	 				</table>
	 			</div>
	 		</div>
	 	</div>
	 </div>
	 <br>
	 <br>

      <script src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
      <script src="js/script.js"></script>
</body>
</html>