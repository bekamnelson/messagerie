 let user = document.getElementById('jsid').value;
  let  scrool  = true;
 
 function fetchMessages() {
            fetch('./../php/fetch_messages.php')
                .then(response => response.json())
                .then(messages => {
                    const messagesContainer = document.getElementById('message2');
                    messagesContainer.innerHTML = ''; // Réinitialiser le conteneur

                    messages.forEach(message => {
                       
                    
                 
                     if(message.del == 1 && message.sender == user ){
                        let del = {
                            "id":message.id,
                            "message":"message suprimer",
                            "tag":1,
                            "timesend" : message.timesend
                        };
                        createMessageRow(del,"message sent del",messagesContainer);

                     }else if((message.del == 3 || message.del ==1)  && message.sender !== user){
                          let del = {
                            "id":message.id,
                            "message":"message suprimer",
                            "tag":1,
                            "timesend" : message.timesend
                        };
                        createMessageRow(del,"message received del",messagesContainer);

                     }else  if((message.sender == user) && (message.del ==0 || message.del ==3 || message.del ==4)){
                        
                           createMessageRow(message,"message sent",messagesContainer);

                     }else if(message.del == 0){
                     
                         createMessageRow(message,"message received",messagesContainer);
                     }
                   
                    });
                  
                   if(scrool){
 messagesContainer.scrollTop = messagesContainer.scrollHeight;
 scrool=false;
                   }
  
               lastconsultation();
                })
                .catch(error => console.error('Erreur :', error));
        }

        // Interroger les nouveaux messages toutes les 5 secondes
        setInterval(fetchMessages, 2000);

          // Fonction pour créer un élément avec toutes ses propriétés
function createElement(type, className, innerHTML = '', appendTo) {
    const element = document.createElement(type);
    if (className) element.className = className;
    if (innerHTML) element.innerHTML = innerHTML;
    if (appendTo) appendTo.appendChild(element);
    return element;
}

// Fonction pour créer une message row
function createMessageRow(object,secondclass,container) {
    const messageRow = createElement('div', 'message-row left', '', container);
    const bubble = createElement('div', 'bubble '+secondclass, '', messageRow);
    bubble.id=object.id;
  
  
    

    // Bloc de citation
    if(object.tag != 1){

    const a =createElement('a','','',bubble);
    a.href=`#${object.tag}`;
    const quoteBox = createElement('div', 'quote-box', '',a);
    const quoteContent = createElement('div', 'quote-content', '', quoteBox);
    createElement('span', 'quote-name', object.tag_username, quoteContent);
    createElement('p', '',object.tag_message, quoteContent);
    createElement('div', 'quote-image', '', quoteBox); // Peut être remplacé par une image
    }

    // Contenu du message
    const messageContent = createElement('div', 'message-content', object.message, bubble);
    createElement('span', 'timestamp',  object.timesend.substring(11, 16), messageContent);

    // Menu
    const menu = createElement('div', 'menu', '', bubble);
    if(object.del == 0){
           const transferMenuItem = createElement('div', 'menu-item', 'Répondre', menu);
    transferMenuItem.addEventListener('click', function() {
        const content =document.getElementById('reply-container');
        const name = document.getElementById('reply-user');
        const tagmessages = document.getElementById('reply-text');
        const hiddenInput = document.getElementById('hiddenInput');

        tagmessages.innerHTML = object.message;
        name.innerHTML = object.tag_username;


        
        hiddenInput.value = object.id; // Change la valeur de l'input caché
       content.style.display = 'flex';







       
    });
    }
 

      const deletemessage = createElement('div', 'menu-item', 'Supprimer', menu);
    deletemessage.addEventListener('click', function() {
        deleteMessage(object.id);
       
    });
    
}

function deleteMessage(messageId) {
    fetch('delete_message.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'id': messageId,  // Passer l'ID du message à supprimer
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            fetchMessages();
        } else if (data.error) {
            alert(data.error);
        }
    })
    .catch(error => {
        console.error("Erreur lors de la suppression:", error);
    });
}


    function lastconsultation(){
       

    fetch('./../php/update.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
           // console.error(data.error);
        } else {
          //  console.log(data.message);
        }
    })
    .catch(error => console.error('Erreur:', error));

    }