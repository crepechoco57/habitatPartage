document.addEventListener("DOMContentLoaded", function () {
  var departementSelect = document.getElementById("departementSelect");
  var villeSearchInput = document.getElementById("villeSearch");
  var villesContainer = document.getElementById("villesContainer");

  villeSearchInput.addEventListener("input", function () {
    var departementCode = departementSelect.value;
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
        console.log(villes);
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
              // Traitez le clic sur la ville ici. Vous pouvez rediriger l'utilisateur, afficher plus d'informations, etc.
              alert("ID de la Ville sélectionnée : " + ville.id);
              alert(document.location.href) + "/" + ville.id;
              document.location.href += "/" + ville.id;
            });

            // Ajoutez le lien de la ville à l'élément <li>.
            liElement.appendChild(villeLink);
            ulElement.appendChild(liElement);
          });
        }
      }
    };

    var data =
      "departement_code=" + departementCode + "&ville_search=" + villeSearch;
    xhr.send(data);
  });
});
