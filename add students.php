
<?php include_once "apps/db.php"; ?>
<?php include_once "apps/function.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>View All Students</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	 <div class="container">
	 	<div class="row">
	 		<div class="card mt-4 mx-auto shadow-lg">
	 			<div class="card-header">
	 				<h2>All Students</h2>
	 				<a href="index.php" class="btn btn-sm btn-outline-info">Add Students</a>
	 				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	 					<input type="text" name="search" placeholder="location/gender/Name" class=" p-1 mt-1">
		 				<input type="submit" name="searchbtn" value="Search" class="btn btn-sm btn-outline-success mb-1 ml-0 p-2">
	 				</form>
	 			</div>
	 			<div class="card-body">
	 				<table class="table table-striped">
	 					<tr>
	 						<th>Id</th>
	 						<th>Name</th>
	 						<th>Email</th>
	 						<th>Cell</th>
	 						<th>Age</th>
	 						<th>Locaiton</th>
	 						<th>Gender</th>
	 						<th>Photo</th>
	 						<th>Status</th>
	 					</tr>
	 					<?php 
                            
                            $search = '';
	 					    if ( isset($_POST['searchbtn']) ) {
	 					    	
	 					    	$search = $_POST['search'];

	 					    }
                            
                            $i = 1;
                            $sql = "SELECT * FROM studentss WHERE location='$search' OR gender='$search' OR name LIKE '%$search%' ";
                            $data = $connection -> query($sql);

                            while( $single_data = $data -> fetch_assoc() ):


	 					 ?>
	 					<tr>
	 						<td><?php echo $i; $i++; ?></td>
	 						<td><?php echo $single_data['name']; ?></td>
	 						<td><?php echo $single_data['email']; ?></td>
	 						<td><?php echo $single_data['cell']; ?></td>
	 						<td><?php echo $single_data['age']; ?></td>
	 						<td><?php echo $single_data['location']; ?></td>
	 						<td><?php echo $single_data['gender']; ?></td>
	 						<td>
	 							<img src="photo/<?php echo $single_data['photo']; ?>" alt="" style="height: 60px; width: 90px; border: 2px solid white;">
	 						</td>
	 						<td>
	 							<a href="view.php?id=<?php echo $single_data['id']; ?>" class="btn btn-sm btn-info">View</a>
	 							<a href="edit.php?id=<?php echo $single_data['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
	 							<a id="delete_btn" href="delete.php?id=<?php echo $single_data['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
	 						</td>
	 					</tr>
	 					<?php endwhile; ?>
	 				</table>
	 			</div>
	 		</div>
	 	</div>
	 </div>


      <script src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
      <script src="js/jquery-3.4.1.js"></script>
      <script src="js/script.js"></script>
      <script>
      	$('a#delete_btn').click(function(){
            
            let con = confirm('Are you sure');

            if ( con == true ) {
                
                 return true;

            }else{
               
                 return false;


            }

      	});
      </script>
</body>
</html>