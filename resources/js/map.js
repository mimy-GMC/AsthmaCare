import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// Fix pour les marqueurs Leaflet avec Vite
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon-2x.png',
    iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
});

export function initMap(lat = 48.8566, lon = 2.3522) {
    const map = L.map('map').setView([lat, lon], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    return map;
}

export function addPollutionLayer(map, data) {
    // Créer un cercle coloré basé sur la qualité de l'air
    const aqi = data.aqi;
    let color, radius;
    
    switch(aqi) {
        case 1: color = 'green'; radius = 2000; break;
        case 2: color = 'yellow'; radius = 3000; break;
        case 3: color = 'orange'; radius = 4000; break;
        case 4: color = 'red'; radius = 5000; break;
        case 5: color = 'purple'; radius = 6000; break;
        default: color = 'gray'; radius = 2000;
    }
    
    L.circle([data.lat, data.lon], {
        color: color,
        fillColor: color,
        fillOpacity: 0.3,
        radius: radius
    }).addTo(map).bindPopup(`
        <strong>Qualité de l'air:</strong> ${getAQILabel(data.aqi)}<br>
        <strong>PM2.5:</strong> ${data.pm2_5} μg/m³<br>
        <strong>PM10:</strong> ${data.pm10} μg/m³
    `);
}

function getAQILabel(aqi) {
    const labels = ['Bon', 'Modéré', 'Malsain pour groupes sensibles', 'Malsain', 'Très malsain', 'Dangereux'];
    return labels[aqi - 1] || 'Inconnu';
}