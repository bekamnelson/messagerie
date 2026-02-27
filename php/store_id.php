<?php
session_start();
header('Content-Type: application/json');
require './config.php';
// Vérifiez si l'ID est passé via POST
if (isset($_POST['contact_id'])) {
    $_SESSION["contact"] = $_POST['contact_id']; // Stocke l'ID dans la session
    

    $contact_id = intval($_POST['contact_id']); // Sécuriser l'entrée
 
    // Requête pour récupérer les informations du contact
    $request = "SELECT username, image FROM users WHERE id_user = ?";
    
    $stmt = $conn->prepare($request);
    $stmt->bind_param("i", $contact_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $contact = $result->fetch_assoc();
       
        echo json_encode(["status" => "success", "contact" => $contact]);
    } else {
        echo json_encode(["status" => "error", "message" => "Contact non trouvé."]);
    }

    // Fermer les ressources
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Aucun ID fourni."]);
}

mysqli_close($conn);
?>
