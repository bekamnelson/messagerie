const url = new URL(window.location.href);

// Récupère les paramètres
const params = new URLSearchParams(url.search);

// Récupère une valeur particulière
const param1 = params.get('contact'); // "valeur1"



if(param1=="error"){
    alert("contact deja existant");
    
}