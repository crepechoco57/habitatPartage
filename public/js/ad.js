document.addEventListener("DOMContentLoaded", function () {
  var departementSelect = document.getElementById("location_departement");
  var villeSearchInput = document.getElementById("location_villeSearch");
  var villesContainer = document.getElementById("villesContainer");
  var villeIdInput = document.getElementById("location_villeId");
  var timeoutId;

  // Fonction pour effectuer la recherche après un délai
  function delayedSearch() {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(function () {
      var codeDepartement = departementSelect.value;
      var villeSearch = villeSearchInput.value;

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

              villeLink.textContent = ville.nom + " - ";
              villeLink.href = "#"; // Vous pouvez définir un lien ici.

              // Ajoutez un gestionnaire d'événements pour gérer le clic sur la ville.
              villeLink.addEventListener("click", function (e) {
                e.preventDefault();

                villeIdInput.value = ville.id;
                villeIdInput.value = ville.id;

                var adFormVilleIdInput = document.getElementById("ad_villeId");
                if (adFormVilleIdInput) {
                  adFormVilleIdInput.value = ville.id;
                }
                console.log(adFormVilleIdInput.value);
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
    }, 300); // Délai de 300 millisecondes (ajustez selon vos besoins)
  }

  // Attacher la fonction delayedSearch à l'événement input
  villeSearchInput.addEventListener("input", delayedSearch);
});
