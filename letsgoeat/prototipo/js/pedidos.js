

function sanitizeInput(input) {
    return input.replace(/[<>\/]/g, ""); // Remove qualquer símbolo suspeito como <, > e /
}

// Aplicando a função de sanitização a todos os campos de texto
document.getElementById('Formulario').addEventListener('submit', function(event) {
    var campos = ['nome', 'apelido', 'morada', 'email']; // busca os 4 campos aos quais se pretende 'sanitizar'

    campos.forEach(function(campoId) {
        var campo = document.getElementById(campoId);
        if (campo && campo.value) {
            campo.value = sanitizeInput(campo.value); // Limpa o valor antes de enviar o formulário
        }
    });
});

// Validação de idade no envio do formulário
document.getElementById('Formulario').addEventListener('submit', function(event) {
    var dataNascimento = document.getElementById('data').value;
    
    if (dataNascimento) {
        var dataNasc = new Date(dataNascimento); // var data de nascimento usando o método Date();
        var hoje = new Date(); // var do dia de hoje usando o método Date();
        var idade = hoje.getFullYear() - dataNasc.getFullYear(); // var que calcula a idade fazendo a diferença entre o ano actual e o ano de nascimento;
        var mes = hoje.getMonth() - dataNasc.getMonth(); // var que vê se a diferença entre os meses do ano actual e o ano de nascimento é negativa;

        // Ajuste no cálculo da idade se o mês/ano atual for antes do aniversário
        if (mes < 0 || (mes === 0 && hoje.getDate() < dataNasc.getDate())) {
            idade--;
        }

        if (idade < 18) {
            alert("Você deve ter pelo menos 18 anos para fazer um pedido.");
            event.preventDefault(); // Impede o envio do formulário
            return; // Sai da função se o usuário for menor de 18 anos
        }
    }
});

// Função para criar o select de quantidade
function novoSelectQuantidade(produtoId, nomeProduto) {
    const container = document.getElementById('quantidadesContainer'); // var que selecciona o elemento com id quantidadesContainer;

    const selectQuantidade = document.createElement('select'); // var que cria um elemento select;
    selectQuantidade.classList.add('form-control', 'quantidade-produto'); // adiciona as classes form-control e quantidade-produto;
    selectQuantidade.name = 'quantidade_' + produtoId; // Atribui um ID único à quantidade do produto seleccionado
    selectQuantidade.dataset.produtoId = produtoId;
    selectQuantidade.id = 'quantidade_' + produtoId;

    const quantidadeMaxima = parseInt(document.querySelector(`option[value='${produtoId}']`).getAttribute('data-quantidade'));  // var que selecciona todas as opções
 // que tenham o Id do produto e o atributo data-quantidade

    if (quantidadeMaxima === 0) {
        const esgotadoMsg = document.createElement('p'); 
        esgotadoMsg.textContent = `O produto ${nomeProduto} está esgotado`;
        esgotadoMsg.style.color = 'red';
        container.appendChild(esgotadoMsg); // se ja não houver stock, cria um parágrafo a vermelho com a mensagem produto x está esgotado;
    } else {
        for (let i = 1; i <= quantidadeMaxima; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            selectQuantidade.appendChild(option); // enquanto i for menor que todas as opções disponíveis, criar um elemento option com valor e textContent = i
        }

        // Adiciona o evento de mudança para atualizar o preço total
        selectQuantidade.addEventListener('change', calcularPrecoTotal);

        // Cria o label e agrupa o select
        const label = document.createElement('label');
        label.textContent = `Quantidade disponível de ${nomeProduto}`;

        // Adiciona ao container
        container.appendChild(label);
        container.appendChild(selectQuantidade);

        setTimeout(function () {
            calcularPrecoTotal();
        }, 100);
    }
}

// Função para remover o select de quantidade
function tirarSelectQuantidade(produtoId) {
    const container = document.getElementById('quantidadesContainer');
    const selectToRemove = container.querySelector(`select[data-produto-id="${produtoId}"]`); // Seleciona o produto com id dentro do select do elemento com id quantidadesContainer

    if (selectToRemove) {
        selectToRemove.previousSibling.remove(); // Remove o label
        selectToRemove.remove(); // Remove o select
    }
}

// Atualiza os selects de quantidade com base na seleção do produto
document.getElementById('produto').addEventListener('change', function () {
    const selectedProdutos = Array.from(this.selectedOptions); // var com o array "produto" de todas as opções seleccionadas;
    const allQuantidades = document.querySelectorAll('#quantidadesContainer select'); // var com todos os selects do elemento com id quantidadesContainer;

    allQuantidades.forEach(select => {
        const produtoId = select.dataset.produtoId;
        if (!selectedProdutos.some(option => option.value === produtoId)) { // se não houver pelo menos uma opção com o value === produtoId, usar a função tirarSelectQuantidade 
            tirarSelectQuantidade(produtoId);
        }
    });

    selectedProdutos.forEach(produto => {
        const produtoId = produto.value;
        const nomeProduto = produto.textContent.split(' - ')[0]; // Extrai o nome do produto do texto da opção
        if (!document.querySelector(`select[data-produto-id="${produtoId}"]`)) {
            novoSelectQuantidade(produtoId, nomeProduto); // Passa o nome do produto
        }
    }); 

});

// Calcula o preço total com base nas quantidades selecionadas
function calcularPrecoTotal() {
    const produtosSelecionados = Array.from(document.getElementById('produto').selectedOptions);
    let precoTotal = 0;

    produtosSelecionados.forEach(produto => {
        const produtoId = produto.value;
        const selectQuantidade = document.querySelector(`#quantidade_${produtoId}`); 
        if (selectQuantidade) {
            const quantidade = parseInt(selectQuantidade.value);
            const preco = parseFloat(produto.dataset.preco);
            precoTotal += preco * quantidade;
        }
    });

    document.getElementById('orcamento').value = precoTotal.toFixed(2) + ' EUR';
}

// Ajusta o tamanho do select para mostrar todas as opções
document.getElementById('produto').addEventListener('click', function() {
    const select = this;

    if (select.size === 1) {
        const options = document.querySelectorAll('#produto option');
        select.size = options.length; // Ajusta o tamanho do select para mostrar todas as opções
    }
});

// Atualiza o preço total ao alterar o produto
document.getElementById('produto').addEventListener('change', calcularPrecoTotal);

$(document).ready(function() {
    var opcoesSelecionadas = [];

     // Função para atualizar as opções selecionadas
     function atualizarOpcoesSelecionadas() {
        opcoesSelecionadas = [];

        $('#produto option:selected').each(function() {
            var nomeProduto = $(this).text().split(' - ')[0];  // Nome do produto
            var produtoId = $(this).val();  // ID do produto

            // Obtém a quantidade selecionada do select correspondente
            var quantidade = $('#quantidade_' + produtoId).val() || 1;

            opcoesSelecionadas.push({
                name: nomeProduto,
                quantity: quantidade  // Adicionar a quantidade ao objeto de produto
            });
        });
    }

    // Evento para detectar quando uma opção de produto for selecionada
    $('#produto').on('change', function() {
        atualizarOpcoesSelecionadas();  // Atualiza as opções selecionadas
    });

    // Evento para detectar quando a quantidade de um produto for alterada
    $('#quantidadesContainer').on('change', 'select.quantidade-produto', function() {
        atualizarOpcoesSelecionadas();  // Atualiza as opções selecionadas
    });

    // Evento para mostrar o alerta e enviar as opções e quantidades quando "Finalizar" for clicado
    $('#finalizar').on('click', function() {
        if (opcoesSelecionadas.length > 0) {
            alert('Opções selecionadas: ' + opcoesSelecionadas.map(op => op.name + ' (Qtd: ' + op.quantity + ')').join(', ') + '\nEnviadas com sucesso!');

            var quantidadeSelecionada = [];
            $('#produto option:selected').each(function() {
                var produtoId = $(this).val();
                var quantidade = $('#quantidade_' + produtoId).val();
                quantidadeSelecionada.push({ produtoId: produtoId, quantidade: quantidade });
            });

            // Combina os dados
            var dataParaEnviar = {
                opcoes: JSON.stringify(opcoesSelecionadas),
                quantidade: JSON.stringify(quantidadeSelecionada)
            };

            // Enviar todos os dados em uma única requisição
            $.post('guardar_opcoes.php', dataParaEnviar, function(response) {
                console.log(response);  // Mostrar a resposta (opcional)
            });
        } else {
            alert("Por favor, selecione pelo menos uma opção.");
        }
    });
});
