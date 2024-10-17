
var mapa = L.map('mapa').setView([51.505, -0.09], 13);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(mapa);

L.Routing.control({
  waypoints: [
      L.latLng(41.0858, -8.3639), // Ponto de partida
      L.latLng(38.71668, -9.13917)  // Ponto de destino
  ],
  routeWhileDragging: true,
  geocoder: L.Control.Geocoder.nominatim() // Adiciona um geocoder para facilitar a busca de locais
}).addTo(mapa);

function calculateRoute() {
  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;

  L.Control.Geocoder.nominatim().geocode(start, function(results) {
      var startLatLng = results[0].center;

      

      L.Control.Geocoder.nominatim().geocode(end, function(results) {
          var endLatLng = results[0].center;

          var routingControl = L.Routing.control({
              waypoints: [
                  L.latLng(startLatLng),
                  L.latLng(endLatLng)
              ],
              routeWhileDragging: true
          });
          mapa.addControl(routingControl);
      });
  });
}




function validate() {
    var nome =  /^.{3,15}$/;
    var email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var numero = /^[0-9]{9}$/;

    var formName = document.getElementById("nome").value;
    var apelidoInserido = document.getElementById("apelido").value;
    var emailInserido = document.getElementById("email").value;
    var numeroInserido = document.getElementById("telemovel").value;
    var motivoInserido = document.getElementById("motivo").value;
    var dataInserida = document.getElementById("data").value;
    if (!nome.test(formName)) {
      alert("Nome invalido");
      return false;
    }
    if (!nome.test(apelidoInserido)) {
      alert("Apelido invalido");
      return false;
    }
    
    if (!numero.test(numeroInserido)) {
      alert("Numero invalido");
      return false;
    }
    if (!email.test(emailInserido)) {
      alert("Email invalido");
      return false;
    }
    if (!dataValida(dataInserida)) {
      alert("Data incorrecta!");
      return false;
    }
    if (!nome.test(motivoInserido)) {
      alert("Insira um motivo");
      return false;
    }
     else {
      alert("Dados submetidos!");
      return true;
    }
  }

  function dataValida(data) {
    var dataParts = data.split("-");
    var year = parseInt(dataParts[0], 10);
    var month = parseInt(dataParts[1], 10);
    var day = parseInt(dataParts[2], 10);
    var date = new Date(year, month - 1, day);
    if (isNaN(date.getTime())) {
        return false;
    }
    return true;
  }
    