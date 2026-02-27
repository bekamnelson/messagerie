 document.getElementById("menuButton").addEventListener("click", function() {
            const menu = document.getElementById("dropdownMenu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        });

        // Pour fermer le menu si on clique en dehors
        window.addEventListener("click", function(event) {
            if (!event.target.matches('#menuButton')) {
                const menu = document.getElementById("dropdownMenu");
                if (menu.style.display === "block") {
                    menu.style.display = "none";
                }
            }
        });

       