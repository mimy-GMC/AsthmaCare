import axios from 'axios';
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

// Générateur de couleurs dynamiques
function generateColors(n) {
    return Array.from({ length: n }, (_, i) => {
        const hue = (i * 360 / n) % 360; // répartir les couleurs sur le cercle chromatique
        return `hsl(${hue}, 70%, 60%)`; // teintes pastel
    });
}

export async function loadCharts() {
    try {
        const res = await axios.get('/api/symptomes');
        const symptoms = res.data;

        const dates = symptoms.map(s => new Date(s.date_debut).toLocaleDateString());
        const intensities = symptoms.map(s => s.intensite);

        // Graphique 1 : Nombre de crises
        new Chart(document.getElementById('chartCrises'), {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{ label: 'Crises', data: dates.map(() => 1), backgroundColor: 'rgba(75,192,192,0.6)' }]
            }
        });

        // Graphique 2 : Intensité
        new Chart(document.getElementById('chartIntensite'), {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{ label: 'Intensité', data: intensities, borderColor: 'rgba(255,99,132,1)', fill: false, tension: 0.3 }]
            }
        });

        // Graphique 3 : Déclencheurs
        const triggersList = symptoms.flatMap(s => s.declencheurs || []);
        const triggersCount = triggersList.reduce((acc, trigger) => {
            acc[trigger] = (acc[trigger] || 0) + 1;
            return acc;
        }, {});

        const triggerLabels = Object.keys(triggersCount);
        const triggerValues = Object.values(triggersCount);

        new Chart(document.getElementById('chartDeclencheurs'), {
            type: 'pie',
            data: {
                labels: triggerLabels,
                datasets: [{
                    data: triggerValues,
                    backgroundColor: generateColors(triggerLabels.length) // couleurs dynamiques
                }]
            }
        });

        new Chart(document.getElementById('chartDeclencheurs'), {
            type: 'pie',
            data: {
                labels: Object.keys(triggersCount),
                datasets: [{ data: Object.values(triggersCount), backgroundColor: ['#f87171', '#60a5fa', '#34d399'] }]
            }
        });
    } catch (error) {
        console.error("Erreur chargement graphiques", error);
    }
}
