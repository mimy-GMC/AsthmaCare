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
    const form = document.getElementById('symptomForm');
    const message = document.getElementById('successMessage');
    const tableBody = document.getElementById('symptomsTable');

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

    // Charger les graphiques seulement si on est sur la page historique
    if (document.getElementById('chartCrises')) {
        loadCharts();
    }
});
