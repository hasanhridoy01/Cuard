
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
        
       //id Receive
       if ( isset($_GET['id']) ) {
            
            $id = $_GET['id'];

         }

         

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

          //Empty manage
       	  if ( empty($name) || empty($email) || empty($cell) || empty($age) || empty($location) || empty($gender) ) {
       	  	
       	  	$massage = '<p class="alert alert-danger mt-2"> All Files are requide! </p>';

       	  }elseif ( filter_var($email, FILTER_VALIDATE_EMAIL) == false ) {
       	  	
       	  	$massage = '<p class="alert alert-info mt-2"> Invalid Email Formate </p>';

       	  }elseif ( $age < 20 || $age > 80 ) {
       	  	
       	  	$massage = '<p class="alert alert-warning mt-2"> Your Age not accepted! </p>';

       	  }else{

              if ( isset($_FILES['new photo']['name']) ) {
                
                 $data = Uploadsystem($_FILES['new photo'],'photo/');
                 $photo_name = $data['file_name'];

              }else{
                  
                $photo_name = $_POST['old photo'];

              }

       	  	
               $data = Uploadsystem($_FILES['photo'],'photo/',['jpg','png','jpeg','gif']);
               $photo = $data['file_name'];
               $sql = "UPDATE studentss SET 
                 
                 name= '$name',
                 email= '$email',
                 cell= '$cell',
                 age= '$age',
                 location= '$location',
                 gender= '$gender',
                 photo= '$photo_name'
                 WHERE id='$id'

               ";
               $connection -> query($sql);

               getMsg('Data Stable');

              
       	  }
       	  

       }

        //Data Receive Form Database
        $sql = "SELECT * FROM studentss WHERE id='$id'";
        $data = $connection -> query($sql);
        $single_data = $data -> fetch_assoc();


     ?>

     <div class="container">
     	<div class="row">
     		<div class="card mt-3 mx-auto shadow-lg">
     			<div class="card-header">
     				<h2>Update Your Profile</h2>
     				<a href="add students.php" class="btn btn-sm btn-outline-info">View all Students</a>
     				<?php 
                      
                if ( isset($massage) ) {
                      	
                  echo $massage;

                }

                setMsg();

     				 ?>
     			</div>
                <div class="card-body">
                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                		
                		<label>Name</label>
                		<input type="text" placeholder="Enter Your Name" class="form-control" name="name" value="<?php echo $single_data['name'];?>">

                		<label>Email</label>
                		<input type="text" placeholder="Enter Your Email" class="form-control" name="email" value="<?php echo $single_data['email'];?>">

                		<label>Cell</label>
                		<input type="text" placeholder="Enter Your Cell" class="form-control" name="cell" value="<?php echo $single_data['cell'];?>">

                		<label>Age</label>
                		<input type="text" placeholder="Enter Your Age" class="form-control" name="age" value="<?php echo $single_data['age'];?>">

                		<label>Location</label>
                		<select class="form-control" name="location">
                			<option>-- select --</option>
                			<option <?php if( $single_data['location'] == 'Mirpur' ): echo "selected"; endif; ?>>Mirpur</option>
                			<option<?php if( $single_data['location'] == 'Uttra' ): echo "selected"; endif; ?>>Uttra</option>
                			<option <?php if( $single_data['location'] == 'Sabar' ): echo "selected"; endif; ?>>Sabar</option>
                			<option <?php if( $single_data['location'] == 'Airport' ): echo "selected"; endif; ?>>Airport</option>
                			<option <?php if( $single_data['location'] == 'Gazipur' ): echo "selected"; endif; ?>>Gazipur</option>
                			<option <?php if( $single_data['location'] == 'Bonani' ): echo "selected"; endif; ?>>Bonani</option>
                			<option <?php if( $single_data['location'] == 'Gulshan' ): echo "selected"; endif; ?>>Gulshan</option>

                			<label>Gender</label>
                			<input type="radio" <?php if( $single_data['gender'] == 'male' ): echo "checked";endif; ?> value="male" name="gender"> male
                			<input type="radio" <?php if( $single_data['gender'] == 'female' ): echo "checked";endif; ?> value="female" name="gender"> female
                			<br>

                       <div class="form-group">
                        <img src="photo/<?php echo $single_data['photo'];?>" style="height: 90px; width: 140px; margin-top: 5px; margin-bottom: 5px; border: 3px solid gray; padding: 5px;">
                        <input type="hidden" name="old photo" value="<?php echo $single_data['photo'];?>">
                       </div>

                			<label>Photo</label>
                			<input type="file" name="new photo">

                			<input type="submit" value="Update" class="btn btn-outline-info" name="submit">

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