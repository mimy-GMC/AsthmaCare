import './bootstrap';

// Import d'Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Import d'Axios
import axios from 'axios';

// Import des graphiques
import { loadCharts } from './chart';

document.addEventListener('DOMContentLoaded', () => {

                        // --- * DOM Elements * ---
    // --- Gestion Symptômes ---
    const form = document.getElementById('symptomForm');
    const message = document.getElementById('successMessage');
    const tableBody = document.getElementById('symptomsTable');

    // --- Gestion Qualité de l'air ---
    const airForm = document.getElementById('airForm');
    const airMessage = document.getElementById('airSuccessMessage');
    const airTable = document.getElementById('airTable');

    // --- Gestion Conseils ---
    const conseilForm = document.getElementById('conseilForm');
    const conseilMessage = document.getElementById('conseilSuccessMessage');
    const conseilTable = document.getElementById('conseilsTable');

                        // --- FONCTIONS SYMPTÔMES ---
    async function loadSymptoms() {
        try {
            const res = await axios.get('/api/symptomes');
            tableBody.innerHTML = ''; // vider avant de recharger

            res.data.forEach(symptome => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="p-3">${new Date(symptome.date_debut).toLocaleString()}</td>
                    <td class="p-3">${symptome.intensite}</td>
                    <td class="p-3">${(symptome.declencheurs || []).join(', ')}</td>
                    <td class="p-3">${symptome.commentaires || ''}</td>
                    <td class="p-3 text-center space-x-2">
                        <button data-id="${symptome.id}" class="edit-btn bg-yellow-500 text-white px-2 py-1 rounded">Modifier</button>
                        <button data-id="${symptome.id}" class="delete-btn bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                    </td>
                `;
                tableBody.appendChild(tr);
            });

            attachDeleteEvents();
            attachEditEvents();
        } catch (error) {
            console.error('Erreur de chargement des symptômes', error);
        }
    }

    //Supprimer un symptôme
    function attachDeleteEvents() {
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
                if (confirm('Supprimer cette entrée ?')) {
                    try {
                        await axios.delete(`/api/symptomes/${btn.dataset.id}`);
                        loadSymptoms(); // rafraîchir la table
                    } catch (error) {
                        console.error('Erreur suppression', error);
                    }
                }
            });
        });
    }

    //Éditer un symptôme
    function attachEditEvents() {
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
                try {
                    const res = await axios.get(`/api/symptomes/${btn.dataset.id}`);
                    const s = res.data;
                    form.date_debut.value = s.date_debut.slice(0, 16);
                    form.intensite.value = s.intensite;
                    document.querySelectorAll('[name="declencheurs[]"]').forEach(cb => {
                        cb.checked = (s.declencheurs || []).includes(cb.value);
                    });
                    form.commentaires.value = s.commentaires || '';
                    form.dataset.editId = s.id;
                } catch (error) {
                    console.error('Erreur édition', error);
                }
            });
        });
    }

    //Soumission formulaire (création / édition)
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);

            const data = {
                date_debut: formData.get('date_debut'),
                intensite: parseInt(formData.get('intensite')),
                declencheurs: formData.getAll('declencheurs[]'),
                commentaires: formData.get('commentaires'),
            };

            try {
                if (form.dataset.editId) {
                    // édition
                    await axios.put(`/api/symptomes/${form.dataset.editId}`, data);
                    delete form.dataset.editId;
                } else {
                    // ajout
                    await axios.post('/api/symptomes', data);
                }

                // Message succès auto-masqué
                message.classList.remove('hidden');
                setTimeout(() => {
                    message.classList.add('hidden');
                }, 5000);
                
                form.reset();
                loadSymptoms();
            } catch (error) {
                if (error.response && error.response.status === 403) {
                    alert('Session expirée. Veuillez vous reconnecter.');
                    window.location.href = '/login';
                } else {
                    console.error('Erreur ajout/modif', error);
                    alert("Une erreur est survenue. Vérifie ta saisie.");
                }
            }
        });
    }

    // Charger les symptômes dès que la page est prête
    loadSymptoms();


                        // --- FONCTIONS AIR QUALITÉ LOCALE --- 
    async function loadAir() {
        try {
            const res = await axios.get('/api/air-qualites');
            airTable.innerHTML = '';

            res.data.forEach(airqualite => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="p-3">${airqualite.date_mesure}</td>
                    <td class="p-3">${airqualite.aqi}</td>
                    <td class="p-3">${airqualite.pm2_5}</td>
                    <td class="p-3">${airqualite.pm10}</td>
                    <td class="p-3">${airqualite.pollen}</td>
                    <td class="p-3">${airqualite.localite}</td>
                    <td class="p-3 space-x-2 text-center">
                        <button data-id="${airqualite.id}" class="edit-air bg-yellow-500 text-white px-2 py-1 rounded">Modifier</button>
                        <button data-id="${airqualite.id}" class="delete-air bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                    </td>
                `;
                airTable.appendChild(tr);
            });

            attachAirDelete();
            attachAirEdit();
        } catch (error) {
            console.error("Erreur chargement qualité air", error);
        }
    }
    
    //Supprimer une mesure
    function attachAirDelete() {
        document.querySelectorAll('.delete-air').forEach(btn => {
            btn.addEventListener('click', async () => {
                if (confirm("Supprimer cette mesure ?")) {
                    try {
                    	await axios.delete(`/api/air-qualites/${btn.dataset.id}`);
                    	loadAir();
                    } catch (error) {
                        console.error('Erreur suppression', error);
		            }
                }
            });
        });
    }

    //Éditer une mesure
    function attachAirEdit() {
        document.querySelectorAll('.edit-air').forEach(btn => {
            btn.addEventListener('click', async () => {
                try {
                     const res = await axios.get(`/api/air-qualites/${btn.dataset.id}`);
                     const a = res.data;
                     airForm.date_mesure.value = a.date_mesure;
                     airForm.aqi.value = a.aqi;
                     airForm.pm2_5.value = a.pm2_5;
                     airForm.pm10.value = a.pm10;
                     airForm.pollen.value = a.pollen;
                     airForm.localite.value = a.localite;
                     airForm.dataset.editId = a.id;
                 } catch (error) {
                     console.error('Erreur édition', error);
                 }
            });
        });
    }

    //Soumission du formulaire qualité de l'air
    if (airForm) {
        airForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(airForm);

            const data = {
                date_mesure: formData.get('date_mesure'),
                aqi: parseInt(formData.get('aqi')),
                pm2_5: parseFloat(formData.get('pm2_5')),
                pm10: parseFloat(formData.get('pm10')),
                pollen: parseInt(formData.get('pollen')),
                localite: formData.get('localite'),
            };

            try {
                if (airForm.dataset.editId) {
                    // édition
                    await axios.put(`/api/air-qualites/${airForm.dataset.editId}`, data);
                    delete airForm.dataset.editId;
                } else {
                    // ajout
                    await axios.post('/api/air-qualites', data);
                }

                // Message succès auto-masqué
                airMessage.classList.remove('hidden');
                setTimeout(() => {
                    airMessage.classList.add('hidden');
                }, 5000);

                airForm.reset();
                loadAir();
            } catch (error) {
                console.error('Erreur ajout/modif', error);
                alert("Une erreur est survenue. Vérifie ta saisie.");
            }
        });
    }

    // Charger la qualité de l'air dès que la page est prête
    loadAir();


                        // --- FONCTIONS AIR QUALITÉ EXTERNE ---
    async function fetchExternalAir(lat, lon){
        try {
            const res = await axios.get(`/api/external/air-qualites?lat=${lat}&lon=${lon}`);
            const data = res.data;

            document.getElementById("aqi").textContent = data.aqi ?? "-";
            document.getElementById("pm25").textContent = data.pm2_5 ?? "-";
            document.getElementById("pm10").textContent = data.pm10 ?? "-";
        } catch(error) {
            console.error("Erreur récupération AQI externe", error);
            alert("Impossible de récupérer les données AQI externes");
        }
    }

    // Événement du bouton
    const externalBtn = document.getElementById("fetchExternalAir");
    if(externalBtn){
        externalBtn.addEventListener('click', ()=>{
            const lat = parseFloat(document.getElementById("lat").value);
            const lon = parseFloat(document.getElementById("lon").value);

           if (!isNaN(lat) && !isNaN(lon)) {
            fetchExternalAir(lat, lon);
        } else {
            alert("Latitude et longitude valides requises !");
        }
        });
    }

    // Optionnel : charger par défaut (ex: Paris)
    fetchExternalAir(48.8566, 2.3522);


                            //--- FONCTIONS CONSEILS ---

    // Charger les conseils
    async function loadConseils() {
        try {
            const res = await axios.get('/api/conseils');
            conseilTable.innerHTML = '';

            res.data.forEach(conseil => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="p-3">${conseil.categorie}</td>
                    <td class="p-3">${conseil.contenu}</td>
                    <td class="p-3">${conseil.niveau_alerte}</td>
                    <td class="p-3 text-center space-x-2">
                        <button data-id="${conseil.id}" class="edit-conseil bg-yellow-500 text-white px-2 py-1 rounded">Modifier</button>
                        <button data-id="${conseil.id}" class="delete-conseil bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                    </td>
                `;
                conseilTable.appendChild(tr);
            });

            attachConseilDelete();
            attachConseilEdit();
        } catch (error) {
            console.error("Erreur chargement conseils", error);
        }
    }

    //Supprimer un conseil
    function attachConseilDelete() {
        document.querySelectorAll('.delete-conseil').forEach(btn => {
            btn.addEventListener('click', async () => {
                if (confirm("Supprimer ce conseil ?")) {
                    try {
                    	await axios.delete(`/api/conseils/${btn.dataset.id}`);
                    	loadConseils();
		    } catch (error) {
			 console.error('Erreur suppression', error);
                    }
                }
            });
        });
    }

    //Editer un conseil
    function attachConseilEdit() {
        document.querySelectorAll('.edit-conseil').forEach(btn => {
            btn.addEventListener('click', async () => {
                try {
                    const res = await axios.get(`/api/conseils/${btn.dataset.id}`);
                    const c = res.data;
                    conseilForm.categorie.value = c.categorie;
                    conseilForm.contenu.value = c.contenu;
                    conseilForm.niveau_alerte.value = c.niveau_alerte;
                    conseilForm.dataset.editId = c.id;
		} catch (error) {
                    console.error('Erreur édition', error);
                }
            });
        });
    }

    //Soumission formulaire de conseils
    if (conseilForm) {
        conseilForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(conseilForm);

            const data = {
                categorie: formData.get('categorie'),
                contenu: formData.get('contenu'),
                niveau_alerte: parseInt(formData.get('niveau_alerte')),
            };

            try {
            	if (conseilForm.dataset.editId) {
  		            // édition
                    await axios.put(`/api/conseils/${conseilForm.dataset.editId}`, data);
                    delete conseilForm.dataset.editId;
            	} else {
		            //ajout
                    await axios.post('/api/conseils', data);
                }

                // Message succès auto-masqué
                conseilMessage.classList.remove('hidden');
                setTimeout(() => conseilMessage.classList.add('hidden'), 5000);

                conseilForm.reset();
                loadConseils();
	        } catch (error) {
                console.error('Erreur ajout/modif', error);
                alert("Une erreur est survenue. Vérifie ta saisie.");
            }
        });
    }

    loadConseils();
    
    // Charger les graphiques seulement si on est sur la page historique
    if (document.getElementById('chartCrises')) {
        loadCharts();
    }


                           // --- DASHBOARD ---
    async function loadDashboard() {
        try {
            // Symptômes (3 derniers)
            const symptRes = await axios.get('/api/symptomes');
            const symptDiv = document.getElementById('dashboard-symptomes');
            if (symptDiv) {
                symptDiv.innerHTML = '';
                symptRes.data.slice(0, 3).forEach(s => {
                    const badgeClass = s.intensite >= 7 ? "bg-red-100 text-red-700 border-red-300" :
                        s.intensite >= 4 ? "bg-yellow-100 text-yellow-700 border-yellow-300" :
                            "bg-green-100 text-green-700 border-green-300"; 

                    const li = document.createElement('li');
                    li.innerHTML = `
                        <span class="font-medium">
                            ${new Date(s.date_debut).toLocaleDateString()}
                        </span> 
                        <span class="ml-2 inline-block px-2 py-0.5 text-xs rounded-full border ${badgeClass}"> 
                            Intensité ${s.intensite}
                        </span>
                    `;
                    symptDiv.appendChild(li);
                });
            }

            // Qualité de l’air (dernière mesure)
            const airRes = await axios.get('/api/air-qualites');
            const airDiv = document.getElementById('dashboard-airQualite');
            if (airDiv && airRes.data.length > 0) {
                const last = airRes.data[0];
                const aqiBadge = last.aqi >= 150 ? "bg-red-100 text-red-700 border-red-300" :
                    last.aqi >= 100 ? "bg-yellow-100 text-yellow-700 border-yellow-300" :
                        "bg-green-100 text-green-700 border-green-300"; 

                airDiv.innerHTML = `
                    <p><strong>AQI:</strong> 
                        <span class="ml-1 px-2 py-0.5 text-xs rounded-full border ${aqiBadge}">
                            ${last.aqi}
                        </span>
                    </p>
                    <p><strong>PM2.5:</strong> ${last.pm2_5}</p>
                    <p><strong>Pollen:</strong> ${last.pollen}</p>
                    <p><strong>Localité:</strong> ${last.localite}</p>
                `;
            }

            // Conseil (prendre le premier dispo)
            const consRes = await axios.get('/api/conseils');
            const consDiv = document.getElementById('dashboard-conseil');
            if (consDiv && consRes.data.length > 0) {
                const conseil = consRes.data[0];
                const levelClass = conseil.niveau_alerte >= 3 ? "bg-red-100 text-red-700 border-red-300" :
                    conseil.niveau_alerte == 2 ? "bg-yellow-100 text-yellow-700 border-yellow-300" :
                        "bg-green-100 text-green-700 border-green-300";

                consDiv.innerHTML = `
                    <p class="font-semibold">
                        ${conseil.categorie}
                    </p>
                    <p>${conseil.contenu}</p>
                    <span class="inline-block mt-2 px-2 py-0.5 text-xs rounded-full border ${levelClass}">
                        Niveau ${conseil.niveau_alerte}
                    </span>
                `;
            }

            // Graphique rapide : nombre de crises par jour
            if (document.getElementById('dashboardChart')) {
                const ctx = document.getElementById('dashboardChart');
                const counts = {};
                symptRes.data.forEach(s => {
                    const day = new Date(s.date_debut).toLocaleDateString();
                    counts[day] = (counts[day] || 0) + 1;
                });

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(counts),
                        datasets: [{
                            label: 'Nombre de crises',
                            data: Object.values(counts),
                        }]
                    }
                });
            }

        } catch (error) {
            console.error("Erreur dashboard", error);
        }
    }

    // Lancer seulement si on est sur la page dashboard
    if (document.getElementById('dashboard-symptomes')) {
        loadDashboard();
    }

});
