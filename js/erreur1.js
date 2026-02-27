// Récupère l'URL actuelle
const url = new URL(window.location.href);

// Récupère les paramètres
const params = new URLSearchParams(url.search);

// Récupère une valeur particulière
const param1 = params.get('email'); // "valeur1"
const param2 = params.get('passeword'); // "valeur2"


if(param1=="error"){
    alert("adresse email deja existant");
    console.log(param1);
}

if(param2=="error"){
    alert("verifier votre mot de passe");
    console.log(param2);
}

 // Lorsque la page est chargée, vérifier Local Storage
       
            if (localStorage.getItem('username')) {
                document.getElementById('username').value = localStorage.getItem('username');
            }
            if (localStorage.getItem('email')) {
                document.getElementById('email').value = localStorage.getItem('email');
            }
      
          console.log(document.getElementById('signupForm'));
        // Lors de la soumission du formulaire, stocker les valeurs dans Local Storage
        document.getElementById('signupForm').addEventListener('submit', function() {
          
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
         
            // Stocker les informations dans Local Storage
            localStorage.setItem('username', username);
            localStorage.setItem('email', email);
        
        });