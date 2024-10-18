
// Função para rolar suavemente até o div com ID
document.querySelector('a[href="#sobrenos"]').addEventListener('click', function(e) {
    e.preventDefault(); // Evita o comportamento padrão de pular diretamente para o div
    document.querySelector('#sobrenos').scrollIntoView({
        behavior: 'smooth'; // Define a rolagem suave
    });
});

