




function notification() {

    fetch('./../php/notification.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    })
    .then(response => response.json())
    .then(data => {
          


               const contactList = document.getElementById('notification');
               contactList.innerHTML ='';

               const div = document.createElement('div');
               div.className ="contact";
               div.innerText = "messages";
               contactList.appendChild(div);
                // Vérifiez si des contacts sont retournés
                if (data.length > 0) {
                    data.forEach(data => {
                        if(data.nombremessages > 0){



  
        // Créer un nouvel élément de liste pour chaque contact
        const contactItem = document.createElement('li');
        contactItem.className = 'contact';
        
        contactItem.innerHTML = `
            <img src="./../images/${data.image}" alt="Avatar de ${data.username}" class="avatar">
            <span class="username">${data.username}</span>
            <div class="notification">
            <span class="unread-label">Non lue</span><span class="nombremessages">${data.nombremessages < 999 ? data.nombremessages:"999\+"}</span>
            </div>
        `;
        contactList.appendChild(contactItem);
   


                        contactItem.addEventListener('click', () => handleContactClick(data.id_contact));

                        }
                         
                        
                    });
                } else {
                     const contactList = document.getElementById('notification');
                      contactList.innerHTML ='';

               const div = document.createElement('div');
              
               div.className ="contact";
               div.innerHTML = " messages <br>";
              
               contactList.appendChild(div);
                    contactList .innerText += 'Aucun notification';
                }
    })
    .catch(error => console.error('Erreur:', error));

}
notification();

    setInterval(notification, 2000);
