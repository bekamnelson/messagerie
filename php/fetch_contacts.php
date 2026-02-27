<?php
session_start();
header('Content-Type: application/json');

require './config.php';

$user = $_SESSION["user_id"]; // Obtenir l'ID utilisateur de la session

// Requête pour récupérer les contacts
$request1 = "SELECT contacts.*, users.username, users.email ,users.image
             FROM contacts
             INNER JOIN users ON users.id_user = contacts.id_contact
             WHERE contacts.id_users = ? 
             ORDER BY users.username ASC";

// Préparer et exécuter la requête
$stmt = $conn->prepare($request1);
$stmt->bind_param("i", $user);
$stmt->execute();
$result = $stmt->get_result();

$contacts = [];
while ($row = $result->fetch_assoc()) {
    $contacts[] = $row; // Ajouter chaque contact au tableau
}

// Fermer les ressources
$stmt->close();
mysqli_close($conn);

// Retourner les contacts au format JSON
echo json_encode($contacts);
?>