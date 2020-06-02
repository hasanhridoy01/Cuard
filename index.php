
<?php include_once "apps/db.php"; ?>
<?php include_once "apps/function.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Students information</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    
    <?php 

       if ( isset($_POST['submit']) ) {
       	  

       	  //Data Receive
       	  $name = $_POST['name'];
       	  $email = $_POST['email'];
       	  $cell = $_POST['cell'];
       	  $age = $_POST['age'];
       	  $location = $_POST['location'];

       	  //Gender manege
       	  if ( isset($_POST['gender']) ) {
       	  	
       	  	$gender = $_POST['gender'];

       	  }

       	  //Data check funciton
       	  $email_check = datacheck($connection, 'email', $email, 'studentss');
       	  $cell_check = datacheck($connection, 'cell', $cell, 'studentss');
          
          //Empty manage
       	  if ( empty($name) || empty($email) || empty($cell) || empty($age) || empty($location) || empty($gender) ) {
       	  	
       	  	$massage = '<p class="alert alert-danger mt-2"> All Files are requide! </p>';

       	  }elseif ( filter_var($email, FILTER_VALIDATE_EMAIL) == false ) {
       	  	
       	  	$massage = '<p class="alert alert-info mt-2"> Invalid Email Formate </p>';

       	  }elseif ( $age < 20 || $age > 80 ) {
       	  	
       	  	$massage = '<p class="alert alert-warning mt-2"> Your Age not accepted! </p>';

       	  }elseif ( $email_check == false ) {
       	  	
       	  	$massage = '<p class="alert alert-warning mt-2"> Email Allready exitis </p>';

       	  }elseif ( $cell_check == false ) {
       	  	
       	  	$massage = '<p class="alert alert-warning mt-2"> Cell Allready exitis </p>';

       	  }else{

       	  	
       	  	if ( !empty($data['mass']) ) {
       	  		
               $massage = $data['mass'];

       	  	}else{
              
               $data = Uploadsystem($_FILES['photo'],'photo/',['jpg','png','jpeg','gif']);
               $photo = $data['file_name'];
               $sql = "INSERT INTO studentss (name, email, cell, age, location, gender, photo, status) VALUES ('$name','$email','$cell','$age','$location','$gender','$photo','active')";
               $connection -> query($sql);
               $massage = '<p class="alert alert-success mt-2"> Data Stable </p>'; 

               getMsg('Data Stable');

               header('location: index.php');

       	  	}
           


       	  }
       	  

       }


     ?>

     <div class="container">
     	<div class="row">
     		<div class="card mt-3 mx-auto shadow-lg">
     			<div class="card-header">
     				<h2>Sign Up</h2>
     				<a href="add students.php" class="btn btn-sm btn-outline-info">View all Students</a>
     				<?php 
                      
                      if ( isset($massage) ) {
                      	
                      	echo $massage;

                      }

                      setMsg();

     				 ?>
     			</div>
                <div class="card-body">
                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                		
                		<label>Name</label>
                		<input type="text" placeholder="Enter Your Name" class="form-control" name="name" value="<?php old('name') ?>">

                		<label>Email</label>
                		<input type="text" placeholder="Enter Your Email" class="form-control" name="email" value="<?php old('email') ?>">

                		<label>Cell</label>
                		<input type="text" placeholder="Enter Your Cell" class="form-control" name="cell" value="<?php old('cell') ?>">

                		<label>Age</label>
                		<input type="text" placeholder="Enter Your Age" class="form-control" name="age" value="<?php old('age') ?>">

                		<label>Location</label>
                		<select class="form-control" name="location">
                			<option>-- select --</option>
                			<option>Mirpur</option>
                			<option>Uttra</option>
                			<option>Sabar</option>
                			<option>Airport</option>
                			<option>Gazipur</option>
                			<option>Bonani</option>
                			<option>Gulshan</option>

                			<label>Gender</label>
                			<input type="radio" value="male" name="gender"> male
                			<input type="radio" value="female" name="gender"> female
                			<br>

                			<label>Photo</label>
                			<input type="file" name="photo">

                			<input type="submit" value="Submit" class="btn btn-outline-info" name="submit">

                		</select>
                	</form>
                </div>
     		</div>
     	</div>
     </div>


      <script src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
      <script src="js/jquery-3.4.1.js"></script>
      <script src="js/script.js"></script>
</body>
</html>