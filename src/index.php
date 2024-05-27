<!-- component -->
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
        #map {
            height: 200px;
            border-radius: 10px;
        }
        .custom-marker {
            font-size: 24px;
            color: #19d28b;
            text-shadow: 1px 1px 2px #484c4a;
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
            display: none;
        }
    </style>
</head>

<body class="relative antialiased bg-gray-100">

    <nav class="p-4 md:py-8 xl:px-0 md:container md:mx-w-6xl md:mx-auto">
        <div class="hidden lg:flex lg:justify-between lg:items-center">
          
            
            <ul class="flex space-x-2 xl:space-x-4 text-sm font-semibold">
                <li>
                    <a href="#">
                        <div id="open-cargo-modal" style="color :#484c4a ; background-color : greenyellow ; width : 100px ; " class="p-2 rounded hover:bg-gray-200">
                          
                                + Cargaison
                        </div>
                    </a>
                </li>
            </ul>
            <!-- <ul class="flex items-center gap-6">
                <li>
                    <a href="#" class="text-sm font-sans text-gray-800 font-semibold tracking-wider">
                       Serigne fallou
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="p-2 rounded hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 stroke-current text-gray-800"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                    </a>
                </li>
            </ul> -->
        </div>
        <div x-data="{ open: false }" class="lg:hidden relative flex justify-between w-full">
            <a href="#" class="flex items-start gap-2 group">
            <img src=" https://i.postimg.cc/j5NZJ2kk/cargo.png" class="w-12 h-12" alt="">
                <!-- <div class="bg-blue-600 text-white p-3 rounded-md group-hover:bg-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div> -->
                <p class="text-sm font-light uppercase">
                    <!-- Dashboard -->
                    <span class="text-base block font-bold tracking-widest">
                        <!-- Atom    -->
                    </span>
                </p>
            </a>
            <button x-on:click="open = !open" type="button" class="bg-gray-200 p-3 rounded-md">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            <!-- </button>
            <div x-show="open" x-transition class="absolute top-14 left-0 right-0 w-full bg-white rounded-md border">
                <ul class="p-4">
                    <li class="px-4 py-2 rounded hover:bg-gray-200">
                        <a href="#" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            My Account
                        </a>
                    </li>
                    <li class="px-4 py-2 rounded hover:bg-gray-200">
                        <a href="#" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            Transactions
                        </a>
                    </li>
                    <li class="px-4 py-2 rounded hover:bg-gray-200">
                        <a href="#" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            Cards
                        </a>
                    </li>
                    <li class="px-4 py-2 rounded hover:bg-gray-200">
                        <a href="#" class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            Offers
                        </a>
                    </li>
                </ul>

            </div> -->
        </div>
    </nav>
    <!-- End Nav -->
    <!-- Start Main -->
    <main class="container mx-w-6xl mx-auto py-4">
        <div class="flex flex-col space-y-8">
            <!-- First Row -->
       
            <!-- End First Row -->
            <!-- Start Second Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 px-4 xl:p-0 gap-4 xl:gap-6 ">
               
           
                <!-- <div class="bg-white p-6 rounded-xl border border-gray-50"> -->
                <!-- <div class="bg-white p-6 rounded-xl  border border-gray-50"> -->
            
            
            </div>
            <!-- End Second Row -->
            <div class="fixed bottom-4 right-4 xl:right-18">
        <!-- <a href="#" class="transform duration-500 ease-in-out animate-bounce bg-teal-400 px-2 py-2 text-white font-mono font-semibold rounded-xl shadow hover:shadow-xl hover:text-white flex justify-between items-center gap-2" id="open-cargo-modal">
            <i class="fas fa-plus-circle text-white text-2xl"></i>
             cargaison
        </a> -->
    </div>


        <div class="fixed inset-0 z-50 overflow-y-auto hidden" id="cargo-modal">
            <div class="flex items-center justify-center min-h-screen px-4 text-center">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>
                <div class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Ajouter une cargaison</h3>
                                    <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" onclick="closeModal()">
                                        <span class="sr-only">Close</span>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="mt-2" id="cargo-form-container">
                                <form id="cargo-form" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="poids-max">Poids maximum</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="poids-max" type="number" placeholder="Entrez le poids maximum">
            <span class="error-message" id="error-poids-max">Veuillez entrer un poids maximum valide.</span>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="prix">Prix total</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="prix" type="number" placeholder="Entrez le prix total">
            <span class="error-message" id="error-prix">Veuillez entrer un prix total valide.</span>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="depart">Lieu de départ</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="depart" type="text" placeholder="Sélectionnez sur la carte" readonly>
            <span class="error-message" id="error-depart">Veuillez sélectionner un lieu de départ.</span>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="arrivee">Lieu d'arrivée</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="arrivee" type="text" placeholder="Sélectionnez sur la carte" readonly>
            <span class="error-message" id="error-arrivee">Veuillez sélectionner un lieu d'arrivée.</span>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="distance">Distance (km)</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="distance" type="number" placeholder="Calculée automatiquement" readonly>
            <span class="error-message" id="error-distance">La distance doit être calculée automatiquement.</span>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="type">Type de cargaison</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="type">
                <option value="">Sélectionnez un type</option>
                <option value="maritime">Maritime</option>
                <option value="aerienne">Aérienne</option>
                <option value="routiere">Routière</option>
            </select>
            <span class="error-message" id="error-type">Veuillez sélectionner un type de cargaison.</span>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="statut">État d'avancement</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="statut">
                <option value="">Sélectionnez un état</option>
                <option value="en-attente">En attente</option>
                <option value="en-cours">En cours</option>
                <option value="termine">Terminé</option>
            </select>
            <span class="error-message" id="error-statut">Veuillez sélectionner un état d'avancement.</span>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="etat">État global</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="etat">
                <option value="">Sélectionnez un état</option>
                <option value="ouvert">Ouvert</option>
                <option value="ferme">Fermé</option>
            </select>
            <span class="error-message" id="error-etat">Veuillez sélectionner un état global.</span>
        </div>
        <div id="map" class="col-span-2"></div>
        <div class="col-span-2 flex items-center justify-between">
            <button id="btn-add-cargo" class="bg-teal-200 hover:bg-teal-600 text-teal-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">Ajouter la cargaison</button>
        </div>
    </form>

</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
function closeModal() {
    document.getElementById('cargo-modal').classList.add('hidden');
}
</script>


            <!-- Start Third Row -->
     <!-- Table with static cargo data -->
 
     <div class="grid grid-cols-1 md:grid-cols-5 items-start px-4 xl:p-0 gap-y-4 md:gap-6 mt-6">
    <div class="col-span-5 bg-white p-6 rounded-xl border border-gray-50">
        <h2 class="text-sm text-gray-600 font-bold tracking-wide mb-4">Filtrer les Cargaisons</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <input id="filter-numero" type="text" placeholder="Filtrer par Numéro" class="py-2 px-4 border rounded-lg">
            <input id="filter-depart" type="text" placeholder="Filtrer par Départ" class="py-2 px-4 border rounded-lg">
            <input id="filter-arrivee" type="text" placeholder="Filtrer par Arrivée" class="py-2 px-4 border rounded-lg">
            <input id="filter-prix-total" hidden type="number" class="py-2 px-4 border rounded-lg">
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poids Max (kg)</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix Total (€)</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Départ</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arrivée</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Distance (km)</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">État</th>
                </tr>
            </thead>
            <tbody id="cargo-table-body" class="divide-y divide-gray-200">
                <!-- Data will be dynamically loaded here -->
            </tbody>
        </table>
        <div id="pagination" class="flex justify-end mt-4"></div>
    </div>
</div>
            <!-- End Third Row -->
        </div>
    </main>
    <!-- End Main -->
  <script src="../dist/app.js" type="module"></script>
  <script>
    // Sélectionner les éléments nécessaires
      // Sélectionner les éléments nécessaires
      const openModalBtn = document.getElementById('open-cargo-modal');
        const cargoModal = document.getElementById('cargo-modal');
        const cargoFormContainer = document.getElementById('cargo-form-container');

        // Créer le formulaire d'ajout de cargaison
        // function createCargoForm() {
        //     const form = document.createElement('form');
        //     form.innerHTML = `
        //         <div>
        //             <label for="poids-max">Poids maximum</label>
        //             <input id="poids-max" type="number" placeholder="Entrez le poids maximum">
        //             <span class="error-message" id="error-poids-max">Veuillez entrer un poids maximum valide.</span>
        //         </div>
        //         <div>
        //             <label for="prix">Prix total</label>
        //             <input id="prix" type="number" placeholder="Entrez le prix total">
        //             <span class="error-message" id="error-prix">Veuillez entrer un prix total valide.</span>
        //         </div>
        //         <div>
        //             <label for="depart">Lieu de départ</label>
        //             <input id="depart" type="text" placeholder="Sélectionnez sur la carte" readonly>
        //             <span class="error-message" id="error-depart">Veuillez sélectionner un lieu de départ.</span>
        //         </div>
        //         <div>
        //             <label for="arrivee">Lieu d'arrivée</label>
        //             <input id="arrivee" type="text" placeholder="Sélectionnez sur la carte" readonly>
        //             <span class="error-message" id="error-arrivee">Veuillez sélectionner un lieu d'arrivée.</span>
        //         </div>
        //         <div>
        //             <label for="distance">Distance (km)</label>
        //             <input id="distance" type="number" placeholder="Calculée automatiquement" readonly>
        //             <span class="error-message" id="error-distance">La distance doit être calculée automatiquement.</span>
        //         </div>
        //         <div>
        //             <label for="type">Type de cargaison</label>
        //             <select id="type">
        //                 <option value="">Sélectionnez un type</option>
        //                 <option value="maritime">Maritime</option>
        //                 <option value="aerienne">Aérienne</option>
        //                 <option value="routiere">Routière</option>
        //             </select>
        //             <span class="error-message" id="error-type">Veuillez sélectionner un type de cargaison.</span>
        //         </div>
        //         <div>
        //             <label for="statut">État d'avancement</label>
        //             <select id="statut">
        //                 <option value="">Sélectionnez un état</option>
        //                 <option value="en-attente">En attente</option>
        //                 <option value="en-cours">En cours</option>
        //                 <option value="termine">Terminé</option>
        //             </select>
        //             <span class="error-message" id="error-statut">Veuillez sélectionner un état d'avancement.</span>
        //         </div>
        //         <div>
        //             <label for="etat">État global</label>
        //             <select id="etat">
        //                 <option value="">Sélectionnez un état</option>
        //                 <option value="ouvert">Ouvert</option>
        //                 <option value="ferme">Fermé</option>
        //             </select>
        //             <span class="error-message" id="error-etat">Veuillez sélectionner un état global.</span>
        //         </div>
        //         <button id="btn-add-cargo" type="button">Ajouter la cargaison</button>
        //     `;
        //     cargoFormContainer.appendChild(form);
        // }

        // Ouvrir le modal
        openModalBtn.addEventListener('click', () => {
            cargoModal.classList.remove('hidden');
            createCargoForm();
        });

        // Fermer le modal
        cargoModal.addEventListener('click', (event) => {
            if (event.target === cargoModal) {
                cargoModal.classList.add('hidden');
            }
        });

        // Initialize the map and set its view to the coordinates of Senegal
        var map = L.map('map').setView([14.4974, -14.4524], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var departMarker;
        var arriveeMarker;

        // Custom icon
        var customIcon = L.divIcon({
            className: 'custom-marker',
            html: '<i class="fas fa-map-marker-alt" style="color: #19d28b; text-shadow: 1px 1px 2px #484c4a;"></i>',
            iconSize: [24, 24],
            iconAnchor: [12, 24]
        });

        map.on('click', function(e) {
            if (!departMarker) {
                departMarker = L.marker(e.latlng, { icon: customIcon }).addTo(map);
                document.getElementById('depart').value = e.latlng.lat + ', ' + e.latlng.lng;
                reverseGeocode(e.latlng, 'depart');
            } else if (!arriveeMarker) {
                arriveeMarker = L.marker(e.latlng, { icon: customIcon }).addTo(map);
                document.getElementById('arrivee').value = e.latlng.lat + ', ' + e.latlng.lng;
                reverseGeocode(e.latlng, 'arrivee');
                calculateDistance();
            } else {
                map.removeLayer(departMarker);
                map.removeLayer(arriveeMarker);
                departMarker = L.marker(e.latlng, { icon: customIcon }).addTo(map);
                document.getElementById('depart').value = e.latlng.lat + ', ' + e.latlng.lng;
                document.getElementById('arrivee').value = '';
                document.getElementById('distance').value = '';
                arriveeMarker = null;
                reverseGeocode(e.latlng, 'depart');
            }
        });

        function calculateDistance() {
            if (departMarker && arriveeMarker) {
                var depart = departMarker.getLatLng();
                var arrivee = arriveeMarker.getLatLng();

                var from = turf.point([depart.lng, depart.lat]);
                var to = turf.point([arrivee.lng, arrivee.lat]);
                var options = { units: 'kilometers' };

                var distance = turf.distance(from, to, options);
                document.getElementById('distance').value = distance.toFixed(2);
            }
        }

        function reverseGeocode(latlng, inputId) {
            var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latlng.lat}&lon=${latlng.lng}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var placeName = data.display_name;
                    document.getElementById(inputId).value = placeName;
                })
                .catch(error => console.log('Error:', error));
        }

        // Variable pour stocker les cargaisons
        let cargos = [];
        const pageSize = 4; // Nombre de cargaisons par page
        let currentPage = 1; // Page actuelle

        // Fonction pour charger les cargaisons depuis le fichier JSON
        function loadCargos() {
            fetch('php/cargo.php')
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erreur lors de la récupération des cargaisons');
                    }
                })
                .then(data => {
                    cargos = data; // Stocker les cargaisons récupérées
                    updateCargos(); // Mettre à jour le tableau des cargaisons
                })
                .catch(error => console.log('Error:', error));
        }

        // Fonction pour mettre à jour le tableau des cargaisons en fonction des critères de filtrage et de pagination
        function updateCargos() {
            const filterNumero = document.getElementById('filter-numero').value.toLowerCase();
            const filterPrixTotal = document.getElementById('filter-prix-total').value.toLowerCase();
            const filterDepart = document.getElementById('filter-depart').value.toLowerCase();
            const filterArrivee = document.getElementById('filter-arrivee').value.toLowerCase();

            // Filtrer les cargaisons selon les critères
            const filteredCargos = cargos.filter(cargo =>
                cargo.numero.toLowerCase().includes(filterNumero) &&
                (filterPrixTotal === '' || cargo.prix.toString().toLowerCase().includes(filterPrixTotal)) &&
                cargo.depart.toLowerCase().includes(filterDepart) &&
                cargo.arrivee.toLowerCase().includes(filterArrivee)
            );

            // Paginer les cargaisons filtrées
            const start = (currentPage - 1) * pageSize;
            const end = start + pageSize;
            const paginatedCargos = filteredCargos.slice(start, end);

            // Afficher les cargaisons paginées
            displayCargos(paginatedCargos);

            // Afficher la pagination
            displayPagination(filteredCargos.length);
        }

        // Ajouter un écouteur d'événement pour les champs de recherche/filtrage
        const searchInputs = document.querySelectorAll('input[type="text"], input[type="number"]');
        searchInputs.forEach(input => {
            input.addEventListener('input', function() {
                currentPage = 1; // Réinitialiser la page actuelle lors de la modification des critères de recherche
                updateCargos();
            });
        });

        // Fonction pour afficher les cargaisons dans le tableau
        function displayCargos(cargos) {
            const tableBody = document.getElementById('cargo-table-body');
            tableBody.innerHTML = ''; // Effacer le contenu existant du tableau
            cargos.forEach(cargo => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="py-2 px-4 text-sm text-gray-500">${cargo.numero}</td>
                    <td class="py-2 px-4 text-sm text-gray-500">${cargo.poids_max}</td>
                    <td class="py-2 px-4 text-sm text-gray-500">${cargo.prix}</td>
                    <td class="py-2 px-4 text-sm text-gray-500">${cargo.depart}</td>
                    <td class="py-2 px-4 text-sm text-gray-500">${cargo.arrivee}</td>
                    <td class="py-2 px-4 text-sm text-gray-500">${cargo.distance}</td>
                    <td class="py-2 px-4 text-sm text-gray-500">${cargo.type}</td>
                    <td class="py-2 px-4 text-sm text-gray-500">${cargo.statut}</td>
                    <td class="py-2 px-4 text-sm">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium ${cargo.etat === 'ouvert' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">${cargo.etat}</span>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Fonction pour afficher la pagination
        function displayPagination(totalCargos) {
            const totalPages = Math.ceil(totalCargos / pageSize);
            const paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = ''; // Effacer la pagination existante

            if (totalPages > 1) {
                for (let i = 1; i <= totalPages; i++) {
                    const pageLink = document.createElement('button');
                    pageLink.textContent = i;
                    pageLink.classList.add('mx-1', 'px-3', 'py-1', 'bg-gray-200', 'text-gray-800', 'border', 'border-gray-300', 'rounded', 'hover:bg-gray-300', 'focus:outline-none', 'focus:bg-gray-300');
                    if (i === currentPage) {
                        pageLink.classList.add('bg-gray-400', 'font-bold');
                    }
                    pageLink.addEventListener('click', function() {
                        currentPage = i;
                        updateCargos();
                    });
                    paginationContainer.appendChild(pageLink);
                }
            }
        }

        // Charger les cargaisons au chargement initial de la page
        document.addEventListener('DOMContentLoaded', loadCargos);

        document.getElementById('cargo-form-container').addEventListener('click', function(event) {
            if (event.target.id === 'btn-add-cargo') {
                var poidsMax = document.getElementById('poids-max');
                var prix = document.getElementById('prix');
                var depart = document.getElementById('depart');
                var arrivee = document.getElementById('arrivee');
                var distance = document.getElementById('distance');
                var type = document.getElementById('type');
                var statut = document.getElementById('statut');
                var etat = document.getElementById('etat');

                var valid = true;

                if (poidsMax.value === '' || isNaN(poidsMax.value) || parseFloat(poidsMax.value) <= 0) {
                    document.getElementById('error-poids-max').style.display = 'inline';
                    valid = false;
                } else {
                    document.getElementById('error-poids-max').style.display = 'none';
                }

                if (prix.value === '' || isNaN(prix.value) || parseFloat(prix.value) <= 0) {
                    document.getElementById('error-prix').style.display = 'inline';
                    valid = false;
                } else {
                    document.getElementById('error-prix').style.display = 'none';
                }

                if (depart.value === '') {
                    document.getElementById('error-depart').style.display = 'inline';
                    valid = false;
                } else {
                    document.getElementById('error-depart').style.display = 'none';
                }

                if (arrivee.value === '') {
                    document.getElementById('error-arrivee').style.display = 'inline';
                    valid = false;
                } else {
                    document.getElementById('error-arrivee').style.display = 'none';
                }

                if (distance.value === '' || isNaN(distance.value) || parseFloat(distance.value) <= 0) {
                    document.getElementById('error-distance').style.display = 'inline';
                    valid = false;
                } else {
                    document.getElementById('error-distance').style.display = 'none';
                }

                if (type.value === '') {
                    document.getElementById('error-type').style.display = 'inline';
                    valid = false;
                } else {
                    document.getElementById('error-type').style.display = 'none';
                }

                if (statut.value === '') {
                    document.getElementById('error-statut').style.display = 'inline';
                    valid = false;
                } else {
                    document.getElementById('error-statut').style.display = 'none';
                }

                if (etat.value === '') {
                    document.getElementById('error-etat').style.display = 'inline';
                    valid = false;
                } else {
                    document.getElementById('error-etat').style.display = 'none';
                }

                if (valid) {
                    var numero = 'CGN' + Math.floor(Math.random() * 1000);  // Génération d'un numéro de cargaison unique

                    var cargo = {
                        numero: numero,
                        poids_max: poidsMax.value,
                        prix: prix.value,
                        depart: depart.value,
                        arrivee: arrivee.value,
                        distance: distance.value,
                        type: type.value,
                        statut: statut.value,
                        etat: etat.value
                    };

                    fetch('php/cargo.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(cargo)
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);  // Log the raw response
                        try {
                            var jsonData = JSON.parse(data);
                            if (jsonData.success) {
                                alert('Cargaison ajoutée avec succès');
                                loadCargos();  // Recharger les cargaisons pour afficher la nouvelle entrée
                                cargoModal.classList.add('hidden');  // Fermer le modal
                            } else {
                                alert('Erreur: ' + jsonData.message);
                            }
                        } catch (e) {
                            console.error('Erreur de parsing JSON:', e);
                            console.error('Données reçues:', data);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                } else {
                    alert('Veuillez corriger les erreurs avant de soumettre le formulaire.');
                }
            }
        });
</script>
</body>

</html>