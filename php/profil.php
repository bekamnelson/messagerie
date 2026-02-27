<?php
session_start();
unset($_SESSION["contact"]);
require './config.php';
$user = $_SESSION["user_id"]; // Obtenir l'ID utilisateur de la session

// Requête pour récupérer les contacts
$request1 = "SELECT * FROM users
             WHERE id_user= ? ";

// Préparer et exécuter la requête
$stmt = $conn->prepare($request1);
$stmt->bind_param("i", $user);
$stmt->execute();
$result = $stmt->get_result();
$result1 = $result;

 if(isset($_POST['submit'])){
    $username= $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm_password'];
    if(isset($username) && $username!=''){
        $request2 = "UPDATE users SET username = '$username'  WHERE id_user = ? ";

// Préparer et exécuter la requête
$stmt1 = $conn->prepare($request2);
$stmt1->bind_param("i", $user);
$stmt1->execute();

    }
    if(isset($email) && $email!=''){
        $request2 = "UPDATE users SET email = '$email'  WHERE id_user = ? ";

// Préparer et exécuter la requête
$stmt1 = $conn->prepare($request2);
$stmt1->bind_param("i", $user);
$stmt1->execute();

    }
     if(isset($password) && $password!=''){
        if($password == $confirmpassword){
            $request2 = "UPDATE users SET password = '$password'  WHERE id_user = ? ";

// Préparer et exécuter la requête
$stmt1 = $conn->prepare($request2);
$stmt1->bind_param("i", $user);
$stmt1->execute();

        }else{
            echo '<script> alert("verifier votre nouveau mot de passe")</script>';
        }
        

    }
   
            if (isset($_FILES['image'])) {
    $targetDir = "./../images/"; // Répertoire de destination
    $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    
    // Créer un nouveau nom de fichier basé sur la date actuelle
    $newFileName = uniqid('user_' . $user . '_') . '.' . $imageFileType; // Générer un nom d'utilisateur unique
    $targetFile = $targetDir . $newFileName; // Nouveau chemin de fichier
    $uploadOk = 1;

    // Vérifier si le fichier est une image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check === false) {
      
             echo '<script> alert("Ce n\'est pas une image.")</script>';
        $uploadOk = 0;
    }

    // Vérifier si le fichier existe déjà
    if (file_exists($targetFile)) {
       
         echo '<script> alert("Désolé, ce fichier existe déjà.")</script>';
        $uploadOk = 0;
    }

    // Vérifier la taille du fichier
    if ($_FILES['image']['size'] > 500000) { // Limite de 500 Ko
        
          echo '<script> alert("Désolé, votre fichier est trop gros.")</script>';
        $uploadOk = 0;
    }

    // Autoriser certains formats de fichiers
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
          echo '<script> alert("Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.")</script>';
        
        $uploadOk = 0;
    }

    // Tenter de télécharger le fichier si tout est ok
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            
            

            // Enregistrer le chemin dans la base de données
            $sql = "UPDATE users SET image='$newFileName' WHERE id_user='$user'";
            if ($conn->query($sql) === TRUE) {
                if ($_SESSION['images']!='no-profil.jpg') {
                    unlink("./../images/".$_SESSION['images']);
                }
             
               
             
               
            } else {
                echo "Erreur : " . $sql . "<br>" . $conn->error;
            }
        } else {
             echo '<script> alert("Désolé, une erreur s\'est produite lors du téléchargement de votre fichier.")</script>';
           
        }
    }

} 


    }
 



?>








<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les Données</title>
   
     <link rel="stylesheet" href="./../css/profil.css">
</head>
<body>
    <div class="navbar">
        <div>
            <a href="./mesagerie.php">retour</a>
        </div>
        <h1>Modifier les Données</h1>
    </div>
    <div class="container">
        <?php while ($row = $result->fetch_assoc()) {
   $_SESSION['images'] = $row['image'];

?>
        <div class="data-display">
            <h3>Données Actuelles</h3>
            <img src="./../images/<?=$row['image']?>" alt="Profil Utilisateur">
            <p><strong>Nom d'utilisateur:</strong> <?php  echo htmlspecialchars($row['username']) ; ?></p>
            <p><strong>Email:</strong><?php  echo htmlspecialchars($row['email'])?></p>
            
           <?php } ?>
        </div>
        <div class="edit-form">
            <h3>Modifier les Informations</h3>
            <form  method="post" id="editForm" enctype="multipart/form-data">
                <input type="text" name="username" placeholder="Nom d'utilisateur" value="" >
                <input type="email" name="email" placeholder="Email" value="" >
               
                     <input type="file" id="fileInput" class="file-input" name="image">
                <input type="password" name="password" placeholder="Nouveau Mot de passe (laisser vide pour ne pas changer)">
                 <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe">
              
                <button type="submit" name="submit">Enregistrer les Modifications</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="./../js/erreur1.js"></script>
</body>
</html>