
var map = L.map('map').setView([39.5, -8.0], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    // Função para adicionar marcadores
    function addMarker(lat, lng, popupText) {
        L.marker([lat, lng]).addTo(map).bindPopup(popupText);
    }
    
    // Adiciona marcadores para as principais cidades de Portugal
    addMarker(38.736946, -9.142685, 'Lisboa'); // Lisboa
    addMarker(41.157944, -8.629105, 'Porto');  // Porto
    addMarker(37.019356, -7.930440, 'Faro');   // Faro
    addMarker(40.203314, -8.410257, 'Coimbra'); // Coimbra
    addMarker(41.550323, -8.420052, 'Braga');  // Braga