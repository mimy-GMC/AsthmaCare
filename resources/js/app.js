import './bootstrap';

// Import d'Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Import d'Axios
import axios from 'axios';

// Import des graphiques
import { loadCharts } from './charts';

document.addEventListener('DOMContentLoaded', () => {
    // --- Gestion Symptômes ---
    const form = document.getElementById('symptomForm');
    const message = document.getElementById('successMessage');
    const tableBody = document.getElementById('symptomsTable');

    // --- Gestion Qualité de l'air ---
    const airForm = document.getElementById('airForm');
    const airMessage = document.getElementById('successMessageAir');
    const airTable = document.getElementById('airTable');

    // --- Gestion Conseils ---
    const conseilForm = document.getElementById('conseilForm');
    const conseilMessage = document.getElementById('successMessageConseil');
    const conseilTable = document.getElementById('conseilTable');

    //Charger la liste au démarrage
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


                            //--- AIR QUALITÉ ---
    //Chargement au démarrage
    async function loadAir() {
        try {
            const res = await axios.get('/api/airqualite');
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
                    	await axios.delete(`/api/airqualite/${btn.dataset.id}`);
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
                     const res = await axios.get(`/api/airqualite/${btn.dataset.id}`);
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
            const airForm = new airFormData(airForm);

            const data = {
                date_mesure: airFormData.date_mesure.value,
                aqi: parseInt(airFormData.aqi.value),
                pm2_5: parseFloat(airFormData.pm2_5.value),
                pm10: parseFloat(airFormData.pm10.value),
                pollen: parseInt(airFormData.pollen.value),
                localite: airFormData.localite.value,
            };

            try {
                if (airForm.dataset.editId) {
                    // édition
                    await axios.put(`/api/airqualite/${airForm.dataset.editId}`, data);
                    delete airForm.dataset.editId;
                } else {
                    // ajout
                    await axios.post('/api/airqualite', data);
                }

                // Message succès auto-masqué
                airMessage.classList.remove('hidden');
                setTimeout(() => {
                    airMessage.classList.add('hidden');
                }, 5000);

                airForm.reset();
                loadAir();
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

    // Charger la qualité de l'air dès que la page est prête
    loadAir();


                            //--- CONSEILS ---

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
            const conseilFormData = new FormData(conseilForm);

            const data = {
                categorie: conseilFormData.categorie.value,
                contenu: conseilFormData.contenu.value,
                niveau_alerte: parseInt(conseilFormData.niveau_alerte.value),
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

    loadConseils();
    
    // Charger les graphiques seulement si on est sur la page historique
    if (document.getElementById('chartCrises')) {
        loadCharts();
    }
});
