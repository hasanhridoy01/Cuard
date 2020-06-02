<?php 

   function Uploadsystem($file_name,$location,$file_format,$file_type = null){
     
     //file Upload System
     $file_name = $_FILES['photo']['name'];
     $file_name_tmp = $_FILES['photo']['tmp_name'];

     //file extrantion
     $file_array = explode('.', $file_name);
     $file_name_extrantion = strtolower(end($file_array));

     //file type manage
     if ( !isset( $file_type['type'] ) ) {
     	
        $file_type['type'] = 'image';

     }
     if ( !isset( $file_type['file_name'] ) ) {
     	
        $file_type['file_name'] = '';

     }
     if ( !isset( $file_type['fname'] ) ) {
     	
        $file_type['fname'] = '';

     }
     if ( !isset( $file_type['lname'] ) ) {
     	
        $file_type['lname'] = '';

     }
     
     //file upload with type
     if ( $file_type['type'] == 'image' ) {
     	
       //file upload
       $file_name = md5(time().rand()).'.'.$file_name_extrantion;

     }elseif (  $file_type['type'] == 'file' ) {
     	
       //file upload
       $file_name = date('d_m_Y_g_h_s').'_'.$file_type['file_name'].'_'.$file_type['fname'].'_'.$file_type['lname'].'.'.$file_name_extrantion;

     }

     //file format manage
     if ( in_array($file_name_extrantion, $file_format) == false ) {
     	
     	$massage = '<p class="alert alert-dark mt-2"> Invalid file format </p>';

     }else{
      
       //Upload
       move_uploaded_file($file_name_tmp, $location . $file_name);

     }

    return[
     
     'mass' => $massage,
     'file_name' => $file_name

    ];

    
   }

   //data check
   function datacheck($conn,$col_name,$data,$table){
    
    $sql = "SELECT * FROM $table WHERE $col_name='$data'";
    $data = $conn -> query($sql);
    $num = $data -> num_rows;

    if ( $num > 0 ) {
       
       return false;

    }else{
       
      return true; 

    }


   }

   //old function
   function old($fild_name){

     if ( isset($fild_name) ) {
     	
     	if ( isset($_POST[$fild_name]) ) {
     		
     		echo $_POST[$fild_name];

     	}

     }

   }

   //flash massage
   function getMsg($msg){
    
    setcookie('msg', $msg, time() + 20);


   }

   function setMsg(){
     
     if ( isset($_COOKIE['msg']) ) {
       
        echo '<p class="alert alert-success mt-2">'.$_COOKIE['msg'].'</p>';

     }


   }

 
 ?>