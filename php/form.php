<?php
require './config.php';
$username = $_POST["username"];
$email = $_POST["email"];
$password=$_POST["password"];
$confirmpasseword = $_POST["confirm_password"];


 $email = mysqli_real_escape_string($conn, $email); // Échapper l'email pour éviter les injections SQL

$request = "SELECT * FROM users WHERE LOWER(email) = LOWER('$email')";
$result = mysqli_query($conn, $request);

if ($result === false) {
    // Gestion des erreurs si la requête échoue
    die("Erreur dans la requête SQL : " . mysqli_error($conn));
}

print_r($result);

if (mysqli_num_rows($result) > 0) {
    echo"bpnjpuio";
  header("Location:  ./../html/form.html?email=error");
}else if($password != $confirmpasseword){
     header("Location:  ./../html/form.html?passeword=error");

}else{




try {
    // Préparation de la requête d'insertion avec des requêtes préparées
    $stmt = $conn->prepare("INSERT INTO users (username,email, password,image) VALUES (?, ?, ?,?)");

    

     // Lier les paramètres
        $imagePath = "./../images/no-profil.jpg"; // Chemin de l'image par défaut
        $stmt->bind_param("ssss", $username, $email, $password, $imagePath);

    // Exécuter la requête
    if ($stmt->execute() === TRUE) {
            $userId = $stmt->insert_id; // Récupérer l'ID de l'utilisateur inséré
            header("Location: ./mesagerie.php?user_id=$userId"); // Rediriger avec l'ID
            exit(); // Ajout de exit pour s'assurer qu'aucun code ne s'exécute après la redirection
        } else {
            throw new Exception("Erreur : " . $stmt->error);
        }

    // Fermer la déclaration
    $stmt->close();
} catch (Exception $e) {
    
    echo "Une erreur est survenue : " . $e->getMessage();
}

}
?>