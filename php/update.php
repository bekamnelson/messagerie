<?php
session_start();
header('Content-Type: application/json');

require 'config.php';
 $user = $_SESSION["user_id"];
    $contact = $_SESSION["contact"];

    // Week format d'insertion manuelle
$now = date("Y-m-d H:i:s"); 

// Préparez la requête
$sql = "UPDATE contacts SET lastshow = ? WHERE id_users = ? AND id_contact = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $now,$user, $contact); // Liez la date au paramètre


   

    // Exécutez la requête
    if ($stmt->execute()) {
        echo json_encode(["message" => "Dernière montre mise à jour avec succès."]);
    } else {
        echo json_encode(["error" => "Erreur lors de la mise à jour."]);
    }

    $stmt->close();


$conn->close();
?>