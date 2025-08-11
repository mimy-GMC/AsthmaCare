import './bootstrap';

// Import d'Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Import d'Axios
import axios from 'axios';

// Script pour gérer le formulaire Journal de Symptômes
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('symptomForm');
    const message = document.getElementById('successMessage');

    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const data = {
                date_debut: formData.get('date_debut'),
                intensite: parseInt(formData.get('intensite')),
                declencheurs: formData.getAll('declencheurs[]').join(', '),
                commentaires: formData.get('Commentaires'),
            };

            try {
                await axios.post('/api/symptomes', data);
                message.classList.remove('hidden');
                form.reset();
            } catch (error) {
                console.error(error);
            }
        });
    }
});
