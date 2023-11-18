//Gestion du filtre des villes selon DPT
//Au click sur une ville : si soumission d'une nouvelle annonce : le formulaire doit récuperer l'id de cette ville
//Au click sur une ville : si consultation des annonces: les annonces dont la ville a cet id doivent s'afficher
document.addEventListener("DOMContentLoaded", function () {
  var departementSelect = document.getElementById("departementSelect");
  var villeSearchInput = document.getElementById("villeSearch");
  var villesContainer = document.getElementById("villesContainer");
  var villeIdInput = document.getElementById("villeId");
  //Encode en JSON le codedepartement selectionné et le contenu de l'input text ( ville )
  villeSearchInput.addEventListener("input", function () {
    var codeDepartement = departementSelect.value;
    var villeSearch = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/ajax/villes-by-departement", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Effacez les anciens résultats.
        villesContainer.innerHTML = "";

        // Analysez la réponse JSON.
        var villes = JSON.parse(xhr.responseText);
        if (villes.length > 0) {
          // Créez une liste <ul> pour afficher les villes.
          var ulElement = document.createElement("ul");
          villesContainer.appendChild(ulElement);

          // Créez un élément <li> pour chaque ville.
          villes.forEach(function (ville) {
            var liElement = document.createElement("li");
            var villeLink = document.createElement("a");
            villeLink.textContent = ville.nom;
            villeLink.href = "#"; // Vous pouvez définir un lien ici.

            // Ajoutez un gestionnaire d'événements pour gérer le clic sur la ville.
            villeLink.addEventListener("click", function (e) {
              e.preventDefault();
              //Ici , il faudra traiter les deux éventualités, soit j'affiche les annonces liées à cette ville
              //soit le formulaire de création d'annonce doit récupérer la valeur de l'id de la ville pour
              //l'envoyer dans la BDD
              villeIdInput.value = ville.id;
            });

            // Ajoutez le lien de la ville à l'élément <li>.
            liElement.appendChild(villeLink);
            ulElement.appendChild(liElement);
          });
        }
      }
    };

    var data =
      "code_departement=" + codeDepartement + "&ville_search=" + villeSearch;
    xhr.send(data);
  });
});
