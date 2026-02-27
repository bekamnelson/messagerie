<?php
session_start();
require 'config.php';

if(isset($_GET["user_id"])){
    $_SESSION["user_id"]=$_GET["user_id"];
}

$user = $_SESSION["user_id"];






?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie - Interface</title>
   
    <link rel="stylesheet" href="./../css/mes2.css">
    <link rel="stylesheet" href="./../css/csstag3.css">
</head>

<body>
    <div id="messageDiv">Message envoyé !</div>
     <input type="hidden" value="<?= $user ?>" name="contact_id" id="jsid">
    <div class="navbar">
        <h1>Messagerie</h1>
        <div><a href="./contact.php">ajouter un contact</a></div>
        <div class="menu-container">
        <button class="menu-button" id="menuButton">Menu</button>
        <div class="dropdown-menu" id="dropdownMenu">
            
         <a href="./close.php">fermer la discusison</a>
           <a href="./profil.php">Profil</a>
       
                
          
              <a href="./deconnexion.php">deconnexion</a>
        </div>
    </div>

    </div>
    </div>
    <div class="content">

<div  class="contacts">
 <div id="notification">

            <div class="contact">
               messages
            </div>

        </div>
        <div  id="contacts">

            <div class="contact">
                contacts
            </div>
    
        </div>
</div>

        <div class="messages" id="messagescont">
           
            <div class="contact" id="contact2">
                <img src="./../images/white.png" alt="" id="imagescontact">
                <span id="zonecontact"></span>
            </div>
           


 
 <div class=" messages2" id="message2">

            </div>
           <div class="send-message">
      

<form method="post" id="formsend" onsubmit="sendMessage(event)">
        <div class="chat-input-wrapper" id="chat-input-wrapper">
            
            <div class="reply-container" id="reply-container">
                <span class="reply-close" onclick="exittag()">×</span>
                <div class="reply-user" id="reply-user"></div>
                <div class="reply-text" id="reply-text">
                </div>
            </div>

            <div class="input-row">
               <!-- <button type="button" class="icon-btn">+</button>-->
                <button type="button" class="icon-btn btn1" id="btnemojie" disabled>😊</button>

                <input type="hidden" id="hiddenInput" name="tag" value="1"/> 
             <textarea  name="message" rows="1" placeholder="Écrire un message..." id="input-set-message" class="txt0" disabled required></textarea>
                
                  <button type="submit" name="submes"  id='btn-set-message' disabled >
      <svg viewBox="0 0 24 24" width="24" height="24" style="background: transparent;">
    <path fill="white" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
</svg>
                  </button>
            </div>
        </div>
    </form>





            </div>
            
        </div>
    </div>
    <script type="text/javascript" src="./../js/menu1.js"></script>
    <script type="text/javascript" src="./../js/message2.js"></script>
     <script type="text/javascript" src="./../js/sendmessage11.js"></script>
     <script type="text/javascript" src="./../js/contact.js"></script>
    <script type="text/javascript" src="./../js/Emoji.js"></script>
      <script type="text/javascript" src="./../js/notificationmessage1.js"></script>
    <script>
        function exittag(){
              const content =document.getElementById('reply-container');
                    content.style.display = 'none';
                     const tag = document.getElementById('hiddenInput');
                      tag.value =1;
        }
      
        new EmojiPicker({
            trigger: [
                {
                    selector: '.btn1',
                    insertInto: ['.txt0'] //If there is only one '.selector', than it can be used without array
                }
            ],
            closeButton: true,
            dragButton: true,
            width: 350,
            height: 370,
            addPosX: -130,
            addPosY: -380,
            tabbed: false,
            navPos: "bottom",
            navButtonReversed: false,
            disableSearch: false,
            hiddenScrollBar: true, // Not for Firefox
            animation: "slideDown",
   
            disableNav: false,
            emojiDim: {
                emojiPerRow: 5,
                emojiSize: 30,
                emojiButtonHeight: 80,
                hideCategory: true
            },
        });

    </script>
    
</body>

</html>