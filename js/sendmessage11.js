function sendMessage(event) {
            event.preventDefault(); // Empêche la soumission par défaut du formulaire
            
            const messageInput = document.getElementById('input-set-message');
            const tag = document.getElementById('hiddenInput');


             const formData = new FormData();
          
            formData.append('message', messageInput.value);
            formData.append('tag', tag.value);
        tag.value =1;
         

           

            fetch('./../php/send_message.php', { // Point vers votre script PHP
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                showMessage();
                if (data.status === 'success') {
                    messageInput.value = ''; // Réinitialiser le champ de saisie
                    scrool  = true;
                    fetchMessages();
                    showMessage();
                    const content =document.getElementById('reply-container');
                    content.style.display = 'none';
                }
            })
            .catch(error => console.error('Erreur:', error));
        }
       
         function showMessage() {
        const messageDiv = document.getElementById('messageDiv');
        messageDiv.style.display = 'block'; // Afficher le message

        // Après 5 secondes, cacher le message
        setTimeout(function() {
            messageDiv.style.display = 'none';
        }, 1500);
    }