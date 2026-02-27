<?php
session_start();
require 'config.php';

$user =$_SESSION["user_id"];
$contact = $_GET["id"];



 $request1 = "SELECT * FROM contacts WHERE id_users='$user' and id_contact='$contact'";
 
$result1 = mysqli_query($conn,$request1);

if (mysqli_num_rows($result1) > 0) {
   header("Location:  ./../php/contact.php?contact=error");

}else{
     $request = "INSERT INTO contacts values($user,$contact,0)";

   mysqli_query($conn,$request);
    
if($user!=$contact){
$request2= "INSERT INTO contacts values($contact,$user,0)";

   mysqli_query($conn,$request2);
}
   header("Location:  ./mesagerie.php");
}




  
      


?>