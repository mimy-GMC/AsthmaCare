import './bootstrap';

// Import d'Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Import d'Axios
import axios from 'axios';

// Import des graphiques
import { loadCharts } from './chart';

// Imports map
import { initMap, addPollutionLayer } from './map';

// ==================== CONFIGURATION AXIOS AUTHENTIFICATION API ====================

// Configuration Axios pour inclure le token
axios.interceptors.request.use(config => {
    const token = localStorage.getItem('sanctum_token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
        config.headers.Accept = 'application/json';
    }
    return config;
});

// Gestion des erreurs d'authentification
axios.interceptors.response.use(
    response => response,
    error => {
        if ([401, 419].includes(error.response?.status)) {
            localStorage.removeItem('sanctum_token');
            window.location.href = '/login';
        }
        return Promise.reject(error);
    }
);



// ===================== CONFIGURATION AUTHENTIFICATION API ======================

// Vérifier si l'utilisateur est connecté
function isAuthenticated() {
    return !!localStorage.getItem('sanctum_token');
}

function requireAuth() {
    if (!isAuthenticated()) {
        window.location.href = '/login';
        return false;
    }
    return true;
}

// Fonction de login API
async function loginAPI(email, password) {
    try {
        await axios.get('/sanctum/csrf-cookie');
        const res = await axios.post('/api/login', { email, password });
        if (res.status === 200) {
            localStorage.setItem('sanctum_token', res.data.token);
            return true;
        }
    } catch (err) {
        console.error('Login error', err);
        return false;
    }
}

// Fonction de logout API
async function logoutAPI() {
    try {
        await axios.post('/api/logout');
    } catch (err) {
        console.error('Logout error', err);
    } finally {
        localStorage.removeItem('sanctum_token');
        window.location.href = '/';
    }
}



// ==================== INITIALISATION ====================

function handleAuthError(error) {
    if ([401, 419].includes(error.response?.status)) {
        localStorage.removeItem('sanctum_token');
        window.location.href = '/login';
    } else {
        console.error('API Error:', error);
        alert("Une erreur est survenue. Vérifie ta saisie.");
    }
}

function safeQuerySelector(id) {
    return document.getElementById(id) || null;
}

// ==================== GESTION DE LA NAVIGATION ====================

document.addEventListener('DOMContentLoaded', () => {
    // Vérification d'authentification pour les pages protégées
    const protectedPages = ['/dashboard', '/journal', '/historique', '/air-qualite', '/conseils', '/carte'];
    if (protectedPages.includes(window.location.pathname) && !isAuthenticated()) {
        window.location.href = '/login';
        return;
    }

    // Gestion du logout
    const logoutBtn = safeQuerySelector('logout-btn');
    if (logoutBtn) logoutBtn.addEventListener('click', async e => {
        e.preventDefault();
        await logoutAPI();
    });

    
    // ==================== FONCTIONS SYMPTÔMES ==================== 
    
    // --- Gestion Symptômes ---
    const form = safeQuerySelector('symptomForm');
    const message = safeQuerySelector('successMessage');
    const tableBody = safeQuerySelector('symptomsTable');
   
    async function loadSymptoms() {
        if (!requireAuth() || !tableBody) return;
        try {
            const res = await axios.get('/api/symptomes');
            console.log('Symptoms API:', res.data);
            tableBody.innerHTML = '';
            res.data.forEach(s => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${new Date(s.date_debut).toLocaleString()}</td>
                    <td>${s.nom}</td>
                    <td>${s.intensite}</td>
                    <td>${(s.declencheurs || []).join(', ')}</td>
                    <td>${s.commentaires || ''}</td>
                    <td>
                        <button data-id="${s.id}" class="edit-btn">Modifier</button>
                        <button data-id="${s.id}" class="delete-btn">Supprimer</button>
                    </td>
                `;
                tableBody.appendChild(tr);
            });
            attachDeleteEvents();
            attachEditEvents();
        } catch (err) {
            handleAuthError(err);
        }
    }

    //Supprimer un symptôme
    function attachDeleteEvents() {
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
                if (!confirm('Supprimer cette entrée ?')) return;
                try {
                    await axios.delete(`/api/symptomes/${btn.dataset.id}`);
                    loadSymptoms();
                } catch (err) {
                    handleAuthError(err);
                }
            });
        });
    }

    //Éditer un symptôme
    function attachEditEvents() {
        if (!form) return;
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
                try {
                    const res = await axios.get(`/api/symptomes/${btn.dataset.id}`);
                    const s = res.data;
                    form.date_debut.value = s.date_debut.slice(0,16);
                    form.nom.value = s.nom;
                    form.intensite.value = s.intensite;
                    document.querySelectorAll('[name="declencheurs[]"]').forEach(cb => cb.checked = (s.declencheurs || []).includes(cb.value));
                    form.commentaires.value = s.commentaires || '';
                    form.dataset.editId = s.id;
                } catch (err) {
                    handleAuthError(err);
                }
            });
        });
    }

    //Soumission formulaire (création / édition)
    if (form) {
        form.addEventListener('submit', async e => {
            e.preventDefault();
            if (!requireAuth()) return;
            const formData = new FormData(form);
            const data = {
                date_debut: formData.get('date_debut'),
                nom: formData.get('nom'),
                intensite: parseInt(formData.get('intensite')),
                declencheurs: formData.getAll('declencheurs[]'),
                commentaires: formData.get('commentaires'),
            };
            console.log('Submit data:', data);
            try {
                if (form.dataset.editId) {
                    await axios.put(`/api/symptomes/${form.dataset.editId}`, data);
                    delete form.dataset.editId;
                } else {
                    await axios.post('/api/symptomes', data);
                }
                if (message) {
                    message.classList.remove('hidden');
                    setTimeout(() => message.classList.add('hidden'), 5000);
                }
                form.reset();
                loadSymptoms();
            } catch (err) {
                handleAuthError(err);
            }
        });
    }


    // ==================== FONCTIONS AIR QUALITÉ ====================

    // --- Gestion Qualité de l'air ---
    const airForm = safeQuerySelector('airForm');
    const airMessage = safeQuerySelector('airSuccessMessage');
    const airTable = safeQuerySelector('airTable');

    async function loadAir() {
        if (!requireAuth() || !airTable) return;
        try {
            const res = await axios.get('/api/air-qualites');
            console.log('Air API:', res.data);
            airTable.innerHTML = '';
            res.data.forEach(a => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${a.date_mesure}</td>
                    <td>${a.aqi}</td>
                    <td>${a.pm2_5}</td>
                    <td>${a.pm10}</td>
                    <td>${a.pollen}</td>
                    <td>${a.localite}</td>
                    <td>
                        <button data-id="${a.id}" class="edit-air">Modifier</button>
                        <button data-id="${a.id}" class="delete-air">Supprimer</button>
                    </td>
                `;
                airTable.appendChild(tr);
            });
            attachAirDelete();
            attachAirEdit();
        } catch(err) {
            handleAuthError(err);
        }
    }
    
    //Supprimer une mesure
    function attachAirDelete() {
        document.querySelectorAll('.delete-air').forEach(btn => {
            btn.addEventListener('click', async () => {
                if (!confirm('Supprimer cette mesure ?')) return;
                try {
                    await axios.delete(`/api/air-qualites/${btn.dataset.id}`);
                    loadAir();
                } catch(err) {
                    handleAuthError(err);
                }
            });
        });
    }

    //Éditer une mesure
    function attachAirEdit() {
        if (!airForm) return;
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
                } catch(err) {
                    handleAuthError(err);
                }
            });
        });
    }

    //Soumission du formulaire qualité de l'air
    if (airForm) {
        airForm.addEventListener('submit', async e => {
            e.preventDefault();
            if (!requireAuth()) return;
            const formData = new FormData(airForm);
            const data = {
                date_mesure: formData.get('date_mesure'),
                aqi: parseInt(formData.get('aqi')),
                pm2_5: parseFloat(formData.get('pm2_5')),
                pm10: parseFloat(formData.get('pm10')),
                pollen: parseInt(formData.get('pollen')),
                localite: formData.get('localite'),
            };
            console.log('Air submit:', data);
            try {
                if (airForm.dataset.editId) {
                    await axios.put(`/api/air-qualites/${airForm.dataset.editId}`, data);
                    delete airForm.dataset.editId;
                } else {
                    await axios.post('/api/air-qualites', data);
                }
                if (airMessage) {
                    airMessage.classList.remove('hidden');
                    setTimeout(() => airMessage.classList.add('hidden'), 5000);
                }
                airForm.reset();
                loadAir();
            } catch(err) {
                handleAuthError(err);
            }
        });
    }


    // ==================== FONCTIONS CONSEILS ====================

    // --- Gestion Conseils ---
    const conseilForm = safeQuerySelector('conseilForm');
    const conseilMessage = safeQuerySelector('conseilSuccessMessage');
    const conseilTable = safeQuerySelector('conseilsTable');

    async function loadConseils() {
        if (!requireAuth() || !conseilTable) return;
        try {
            const res = await axios.get('/api/conseils');
            console.log('Conseils API:', res.data);
            conseilTable.innerHTML = '';
            res.data.forEach(c => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${c.categorie}</td>
                    <td>${c.contenu}</td>
                    <td>${c.niveau_alerte}</td>
                    <td>
                        <button data-id="${c.id}" class="edit-conseil">Modifier</button>
                        <button data-id="${c.id}" class="delete-conseil">Supprimer</button>
                    </td>
                `;
                conseilTable.appendChild(tr);
            });
            attachConseilDelete();
            attachConseilEdit();
        } catch(err) {
            handleAuthError(err);
        }
    }


    //Supprimer un conseil
    function attachConseilDelete() {
        document.querySelectorAll('.delete-conseil').forEach(btn => {
            btn.addEventListener('click', async () => {
                if (!confirm('Supprimer ce conseil ?')) return;
                try {
                    await axios.delete(`/api/conseils/${btn.dataset.id}`);
                    loadConseils();
                } catch(err) {
                    handleAuthError(err);
                }
            });
        });
    }

    //Editer un conseil
    function attachConseilEdit() {
        if (!conseilForm) return;
        document.querySelectorAll('.edit-conseil').forEach(btn => {
            btn.addEventListener('click', async () => {
                try {
                    const res = await axios.get(`/api/conseils/${btn.dataset.id}`);
                    const c = res.data;
                    conseilForm.categorie.value = c.categorie;
                    conseilForm.contenu.value = c.contenu;
                    conseilForm.niveau_alerte.value = c.niveau_alerte;
                    conseilForm.dataset.editId = c.id;
                } catch(err) {
                    handleAuthError(err);
                }
            });
        });
    }

    //Soumission formulaire de conseils
    if (conseilForm) {
        conseilForm.addEventListener('submit', async e => {
            e.preventDefault();
            if (!requireAuth()) return;
            const formData = new FormData(conseilForm);
            const data = {
                categorie: formData.get('categorie'),
                contenu: formData.get('contenu'),
                niveau_alerte: parseInt(formData.get('niveau_alerte')),
            };
            console.log('Conseil submit:', data);
            try {
                if (conseilForm.dataset.editId) {
                    await axios.put(`/api/conseils/${conseilForm.dataset.editId}`, data);
                    delete conseilForm.dataset.editId;
                } else {
                    await axios.post('/api/conseils', data);
                }
                if (conseilMessage) {
                    conseilMessage.classList.remove('hidden');
                    setTimeout(() => conseilMessage.classList.add('hidden'), 5000);
                }
                conseilForm.reset();
                loadConseils();
            } catch(err) {
                handleAuthError(err);
            }
        });
    }

    // ==================== FONCTIONS AIR QUALITÉ EXTERNE ====================
    
    async function fetchExternalAir(lat, lon){
        if (!requireAuth()) return;
        
        try {
            const res = await axios.get(`/api/external/air-qualites?lat=${lat}&lon=${lon}`);
            const data = res.data;

            document.getElementById("aqi").textContent = data.aqi ?? "-";
            document.getElementById("pm25").textContent = data.pm2_5 ?? "-";
            document.getElementById("pm10").textContent = data.pm10 ?? "-";
        } catch(error) {
            console.error("Erreur récupération AQI externe", error);
            handleAuthError(error);
        }
    }

    // ==================== DASHBOARD ====================
    async function loadDashboard() {
        const token = localStorage.getItem('sanctum_token');
        if (!token) return;

        try {
            // Symptômes (3 derniers)
            const symptomes = await axios.get('/api/symptomes');
            const symptomesList = document.getElementById('dashboard-symptomes');
            if (symptomes.data && symptomes.data.length > 0) {
                symptomesList.innerHTML = '';
                symptomes.data.slice(0, 5).forEach(s => {
                    symptomesList.innerHTML += `
                        <li class="flex justify-between items-center">
                            <span>${s.type || 'Crise'} - ${new Date(s.date_debut).toLocaleDateString()}</span>
                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-600">${s.intensite}</span>
                        </li>`;
                });
            } else {
                symptomesList.innerHTML = `<li class="text-gray-500 italic">Aucune crise enregistrée</li>`;
            }

            // Qualité de l’air (dernière mesure)
            const airQualite = await axios.get('/api/air-qualites');
            const airQualiteDiv = document.getElementById('dashboard-airQualite');
            if (airQualite.data && airQualite.data.length > 0) {
                const last = airQualite.data[airQualite.data.length - 1];
                airQualiteDiv.innerHTML = `
                    <p><strong>Ville:</strong> ${last.localite}</p>
                    <p><strong>AQI:</strong> ${last.aqi}</p>
                    <p><strong>PM2.5:</strong> ${last.pm2_5} µg/m³</p>`;
            } else {
                airQualiteDiv.innerHTML = `<p class="text-gray-500 italic">Données non disponibles</p>`;
            }

            // Conseil (prendre le premier dispo)
            const conseils = await axios.get('/api/conseils');
            const conseilDiv = document.getElementById('dashboard-conseil');
            if (conseils.data && conseils.data.length > 0) {
                conseilDiv.innerHTML = `<p>${conseils.data[0].contenu}</p>`;
            } else {
                conseilDiv.innerHTML = `<p class="text-gray-500 italic">Aucun conseil disponible</p>`;
            }

            // Graphique rapide : nombre de crises par jour
            if (document.getElementById('dashboardChart')) {
                const ctx = document.getElementById('dashboardChart').getContext('2d');

                // Nettoyer le graphique précédent s'il existe déjà
                if (window.dashboardChart) {
                    window.dashboardChart.destroy();
                }

                const counts = {};
                symptomes.data.forEach(s => {
                    const day = new Date(s.date_debut).toLocaleDateString();
                    counts[day] = (counts[day] || 0) + 1;
                });

                window.dashboardChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(counts),
                        datasets: [{
                            label: 'Nombre de crises',
                            data: Object.values(counts),
                            backgroundColor: 'rgba(59, 130, 246, 0.5)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: { responsive: true, scales: { y: { beginAtZero: true } } }
                });
            }

        } catch (error) {
            console.error("Erreur Dashboard:", error);
            document.getElementById('dashboard-symptomes').innerHTML = `<li class="text-red-500">Erreur de chargement</li>`;
            document.getElementById('dashboard-airQualite').innerHTML = `<p class="text-red-500">Erreur de chargement</p>`;
            document.getElementById('dashboard-conseil').innerHTML = `<p class="text-red-500">Erreur de chargement</p>`;
        }
    }

    // ==================== INITIAL LOAD ====================
    if (isAuthenticated()) {
        loadSymptoms();
        loadAir();
        loadConseils();

        if (document.getElementById('chartCrises')) loadCharts();
        if (document.getElementById('dashboard-symptomes')) loadDashboard();
        if (document.getElementById('map')) loadMap();
    }

    // ==================== FONCTION MAP ====================
    async function loadMap() {
        if (!requireAuth()) return;
        const mapEl = document.getElementById('map');
        if (!mapEl) return;
        const map = initMap();

        try {
            const pos = await getCurrentPosition();
            map.setView([pos.coords.latitude, pos.coords.longitude], 13);
            const res = await axios.get(`/api/external/air-qualites?lat=${pos.coords.latitude}&lon=${pos.coords.longitude}`);
            addPollutionLayer(map, { ...res.data, lat: pos.coords.latitude, lon: pos.coords.longitude });
        } catch(err) {
            console.error('Map error:', err);
            const res = await axios.get('/api/external/air-qualites?lat=48.8566&lon=2.3522');
            addPollutionLayer(map, { ...res.data, lat: 48.8566, lon: 2.3522 });
        }
    }

    function getCurrentPosition() {
        return new Promise((resolve, reject) => {
            if (!navigator.geolocation) return reject(new Error('Géolocalisation non supportée'));
            navigator.geolocation.getCurrentPosition(resolve, reject);
        });
    }
});


