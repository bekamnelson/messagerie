<?php

require 'config.php';

$email = $_POST["email"];
$password=$_POST["password"];




$email = mysqli_real_escape_string($conn, $email); // Échapper l'email pour éviter les injections SQL

$request = "SELECT * FROM users WHERE LOWER(email) = LOWER('$email')";
$result = mysqli_query($conn, $request);

if ($result === false) {
    // Gestion des erreurs si la requête échoue
    die("Erreur dans la requête SQL : " . mysqli_error($conn));
}



if (mysqli_num_rows($result) == 0) {
    
  header("Location:  ./../html/login.html?email=error");
}else {
       $pass = mysqli_fetch_assoc(mysqli_query($conn,$request));
     if($pass['password'] != $password){
   

     header("Location:  ./../html/login.html?passeword=error");

}else{



  if($pass['password'] == $password){
       
       header("Location:  ./mesagerie.php?user_id=" .$pass['id_user']);
  }
      
    } 
     
}
 
   
?>