<?php


// Paramètres de connexion à la base de données
$host = 'localhost'; // L'adresse du serveur MySQL
$dbname = 'messagerie'; // Le nom de votre base de données
$username = 'root'; // Votre nom d'utilisateur MySQL
$password = ''; // Votre mot de passe MySQL

// Création de la connexion
$conn = new mysqli($host, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
} 






?>