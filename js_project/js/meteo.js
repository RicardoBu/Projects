function carregar() {
    // ler o ficheiro
    var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 &&this.status == 200) {
            mostrar(this);
        }
    };
xhttp.open("GET", "meteo.xml", true);
xhttp.send();
    // carregar usando variáveis
function mostrar(xml) {
        var nome, i, objHttp, frase;
        objHttp = xml.responseXML;
        frase = "";
        nome = objHttp.getElementsByTagName('nome');
        estado = objHttp.getElementsByTagName('estado');
        max = objHttp.getElementsByTagName('maxima');
        min = objHttp.getElementsByTagName('minima');
        for (i = 0 ; i <nome.length; i++) {
            frase += "<b>" + nome[i].childNodes[0].nodeValue + "</b><br/>";
            frase += "Cidade: <b>" + nome[i].childNodes[0].nodeValue + "</b><br/>";
            frase += "Estado do céu: " + estado[i].childNodes[0].nodeValue + "<br>";
            frase += "Temperatura Máxima: " + max[i].childNodes[0].nodeValue + "<br>";
            frase += "Temperatura Mínima: " + min[i].childNodes[0].nodeValue +"<br/><br/><br/>";
                            }
            document.getElementById("meteo").innerHTML = frase;
            document.getElementById("meteo").style.backgroundColor = "white";
                        }
                    }

function bemVindo() {
    alert("Bem-vindo!");
}
var boasVindas = setTimeout( bemVindo, 5000);