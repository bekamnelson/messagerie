<?php
session_start();
header('Content-Type: application/json');

require './config.php';

// Vérifiez si l'ID du message est passé
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $user = $_SESSION["user_id"];
    
    // Préparez la requête pour sélectionner la valeur de la colonne 'del'
    $sql = "SELECT del,sender FROM messages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['sender'] ==  $user){
$newDelValue = ($row['del'] === 0) ? 1 : 2; // Vérifie la valeur de 'del'
            }else{
                $newDelValue = ($row['del'] === 0) ? 3 : 4; // Vérifie la valeur de 'del'
            }
            

            // Préparez la requête pour mettre à jour la colonne 'del'
            $sqlUpdate = "UPDATE messages SET del = ? WHERE id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("ii", $newDelValue, $id);

            if ($stmtUpdate->execute()) {
                echo json_encode(["message" => "Valeur mise à jour avec succès"]);
            } else {
                echo json_encode(["error" => "Erreur lors de la mise à jour"]);
            }

            $stmtUpdate->close();
        } else {
            echo json_encode(["error" => "Message non trouvé"]);
        }
    } else {
        echo json_encode(["error" => "Erreur lors de la sélection"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "ID non spécifié"]);
}

$conn->close();
?>


