<?php
session_start();
require './config.php';
if(isset($_SESSION["contact"])){


$user = $_SESSION["user_id"];
$contact = $_SESSION["contact"];

$request = "SELECT m1.*, 
       u.username, 
       m2.message AS tag_message, 
       u2.username AS tag_username  
FROM messages AS m1
INNER JOIN users AS u ON m1.sender = u.id_user 
LEFT JOIN messages AS m2 ON m1.tag = m2.id 
LEFT JOIN users AS u2 ON m2.sender = u2.id_user  
WHERE (m1.sender = $user AND m1.receiver = $contact) 
   OR (m1.receiver =$user AND m1.sender = $contact) 
ORDER BY m1.timesend ASC;"; 
$result = mysqli_query($conn, $request);

$messages = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row; // Ajoute chaque message à un tableau
    }
    mysqli_free_result($result);
}

mysqli_close($conn);

// Retourner les messages au format JSON
header('Content-Type: application/json');
echo json_encode($messages);
}else {
    echo json_encode(["message" => "Bonjour, comment ça va ?"]);
}




?>