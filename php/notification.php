<?php
session_start(); 


header('Content-Type: application/json');

require './config.php';

$user = $_SESSION["user_id"];

    // Préparez la requête
    $sql = "SELECT DISTINCT
    users.username, users.image, users.id_user,contacts.*,
    COUNT(messages.message) AS nombremessages
FROM 
    users
INNER JOIN 
    contacts ON users.id_user = contacts.id_contact 
LEFT JOIN 
    messages ON contacts.id_contact = messages.sender
              AND messages.timesend > contacts.lastshow
WHERE 
    contacts.id_users = ? AND messages.receiver = ?
GROUP BY 
    users.username;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user,$user);

    // Exécutez la requête
    $stmt->execute();
    $result = $stmt->get_result();

    // Récupérez les résultats
    $contacts = [];
    while ($row = $result->fetch_assoc()) {
        $contacts[] = $row;
    }

    // Affichez le résultat
    echo json_encode($contacts);

    // Fermez la déclaration et la connexion
    $stmt->close();


$conn->close();
?>