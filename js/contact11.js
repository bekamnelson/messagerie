 function fetchContacts() {
        fetch('./../php/fetch_contacts.php') // Point vers votre script PHP
            .then(response => response.json())
            .then(contacts => {
                const contactsContainer = document.getElementById('contacts');
               
               
                // Vérifiez si des contacts sont retournés
                if (contacts.length > 0) {
                    contacts.forEach(contact => {
                         
                        const div = document.createElement('div');
                     div.classList.add("contact");
                         div.setAttribute('id', 'takecontact'); 
                        div.setAttribute('data-id', contact.id_contact);
                        
                        const img = document.createElement('img');
                        img.src = './../images/'+contact.image;
                        div.appendChild(img);
                        
                        div.innerHTML += ` ${contact.username}`;
                        contactsContainer.appendChild(div);
                        div.addEventListener('click', () => handleContactClick(contact.id_contact));
                    });
                } else {
                    contactsContainer.innerText = 'Aucun contact trouvé.';
                }
            })
            .catch(error => console.error('Erreur :', error));
    }

    // Appel initial pour récupérer les contacts
    fetchContacts();

  function handleContactClick(contactId) {
        
  console.log(contactId);
        // Envoyer une requête AJAX pour récupérer le contact
        fetch('./../php/store_id.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ contact_id: contactId }) // Envoie l'ID du contact
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
              scrool  = true;
              const cont = document.querySelectorAll('.messages');
               cont[0].style.display="none";
               cont[1].style.display="flex";



                const img = document.getElementById('imagescontact');
                const span = document.getElementById('zonecontact');
                 const input = document.getElementById('input-set-message');
                 const btn = document.getElementById('btn-set-message');
                const btn1 = document.getElementById('btnemojie');
                span.innerText = data.contact.username;
               
                const div = document.createElement('div');
                        div.classList.add("contact");
                        
                        img.src =  './../images/'+data.contact.image;
                        console.log(img.src);
                        input.disabled = false;
                          btn.disabled = false;
                          btn1.disabled = false;
                       
                        fetchMessages();
                        

                
            } else {
                console.error(data.message); // Affiche l'erreur dans la console
            }
        })
        .catch(error => console.error('Erreur :', error));
    }




