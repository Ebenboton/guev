document.addEventListener("DOMContentLoaded", function(){
    const searchInput = document.querySelector(".search-input");
    // Crée une zone de suggestions et l'ajoute sous le champ de recherche
    const suggestionList = document.createElement("div");
    suggestionList.className = "suggestion-list";
    searchInput.parentNode.style.position = "relative"; // pour positionner la liste par rapport au conteneur
    searchInput.parentNode.appendChild(suggestionList);

    searchInput.addEventListener("input", function(){
        const term = searchInput.value.trim();
        if(term.length === 0){
            suggestionList.innerHTML = "";
            suggestionList.style.display = "none";
            return;
        }
        fetch(`config/search-product.php?term=${encodeURIComponent(term)}`)
        .then(response => response.json())
        .then(products => {
            suggestionList.innerHTML = "";
            if(products.length > 0){
                products.forEach(product => {
                    const div = document.createElement("div");
                    div.className = "suggestion-item";
                    // Affiche le nom et la catégorie, par exemple
                    div.textContent = product.nom + " - " + product.categorie;
                    div.addEventListener("click", function(){
                        searchInput.value = product.nom;
                        suggestionList.innerHTML = "";
                        suggestionList.style.display = "none";
                        // Optionnel : vous pouvez déclencher la soumission du formulaire ici
                    });
                    suggestionList.appendChild(div);
                });
                suggestionList.style.display = "block";
            } else {
                suggestionList.style.display = "none";
            }
        })
        .catch(error => console.error("Erreur lors de la recherche: ", error));
    });

    // Masquer la liste lorsqu'on clique en dehors
    document.addEventListener("click", function(e){
        if(!searchInput.contains(e.target) && !suggestionList.contains(e.target)){
            suggestionList.innerHTML = "";
            suggestionList.style.display = "none";
        }
    });
});