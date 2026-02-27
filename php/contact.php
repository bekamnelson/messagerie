
<?php
session_start();

require './config.php';
if(isset($_POST["submit2"])){
$search = $_POST["search"]??'';

 
        $request = "SELECT * FROM users WHERE LOWER(email) LIKE LOWER('%$search%')";
 
$result = mysqli_query($conn,$request);
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Contacts</title>
    <link rel="stylesheet" href="./../css/contact2.css">
</head>

<body>
    <nav>
        <div>
            <a href="./mesagerie.php">retour</a>
        </div>
    </nav>
    <div class="container">
        <h1>Recherche de Contacts</h1>
        <form method="POST" class="form-contact">
            <input type="email" name="search" placeholder="entrer l'email du contact" required>
            <input type="submit" value="Rechercher" name="submit2">
        </form>

<?php
               

      


 // Affichage des résultats
 if(isset($result)){
                if (mysqli_num_rows($result) > 0) {

                        echo ' <div class="content">';
        
                    while ($row = mysqli_fetch_assoc($result)) {
                         echo ' <div class="contact">';

                         ?><div class="image">
                                <img src="./../images/<?= $row['image'] ?>" alt="<?= $row['username'] ?>">
                         </div>
                         
                         <div class="username">
                         <?php
                        
                         echo  htmlspecialchars($row['username']);
                           ?>
                           </div>
                           <div class="btn-send">
                                <form action="./ajouter.php" method="get">
                        <input type="hidden" value="<?= $row['id_user'] ?>" name="id">
                        <input type="submit" value="ajouter" name="submit">
                         </form>
                           </div>
                      
                    <?php
                       echo "</div>";
                    }
                    echo "</div>";
                  
                } else {
                    echo "Aucun contact trouvé.";
                }
}
         
        ?>
    </div>
    <script type="text/javascript" src="./../js/erreur3.js"></script>
</body>

</html>