<?php
session_start(); 

require './config.php';

// Vérifiez que les variables de session et POST sont définies
if (isset($_SESSION["user_id"]) && isset($_SESSION["contact"]) && isset($_POST["message"])) {
    $user = $_SESSION["user_id"];
    $contact = $_SESSION["contact"];
    $message = trim($_POST["message"]); 
   
    $tag =  intval(trim($_POST['tag']));
    
  
    $time = date("Y-m-d H:i:s");

    // Validation de la longueur du message
    if (strlen($message) == 0 || strlen($message) > 255) {
        echo json_encode(["status" => "error", "message" => "Le message doit avoir entre 1 et 255 caractères."]);
        exit;
    }

    // Préparer la requête pour insérer le message
 $stmt = $conn->prepare("INSERT INTO messages (receiver, sender, message, timesend, tag, del) VALUES (?, ?, ?, ?, ?, 0)");

    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Erreur lors de la préparation de la requête : " . $conn->error]);
        exit;
    }

    $stmt->bind_param("iissi", $contact, $user, $message, $time, $tag); // "iissi" correspond aux types de paramètres

    // Exécutez la requête et vérifiez si l'insertion a réussi
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Message envoyé avec succès !"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erreur lors de l'envoi du message : " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Erreur : toutes les données requises ne sont pas disponibles."]);
}

mysqli_close($conn);
?>