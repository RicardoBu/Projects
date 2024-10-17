function validate(event) {
  event.preventDefault();
    var nome = /^[a-z\d_]{3,15}$/i;
    var email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var numero = /^[0-9]{9}$/;
    

    var formName = document.getElementById("nome").value;
    var apelidoInserido = document.getElementById("apelido").value;
    var numeroInserido = document.getElementById("telemovel").value;
    var tipoPagina = document.getElementById("tipoPagina").value;
    var prazoInserido = document.getElementById("prazo").value;
   
    
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
    if(tipoPagina == "") {
        alert("Escolha uma opcao");
        return false;
    }
    
    
    else {
      alert("Dados submetidos!");
      return true;
    }
  }

function calculateBudget() {

  var tipoPagina = parseFloat(document.getElementById("tipoPagina").value);
  var prazo = parseFloat(document.getElementById("prazo").value);
  
var separadores = document.querySelectorAll('#separadores input[type="checkbox"]:checked');
 var totalSeparadores = 0;
  separadores.forEach( function(separador) {
    totalSeparadores += parseInt(separador.value);
  } )
  
var resultado = (tipoPagina + totalSeparadores)*prazo;

var orcamento = document.getElementById("orcamento");
orcamento.value = resultado.toFixed(2) + " EUR";



}
  
    