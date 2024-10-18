


    document.addEventListener('DOMContentLoaded', function () {
        // Selecionar todas as imagens dentro de links de lightbox
        const lightboxLinks = document.querySelectorAll('a[data-lightbox="meal"]');
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxDescription = document.getElementById('lightboxDescription');
        const closeButton = document.getElementById('closeButton');
    
        lightboxLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault(); // Impedir o comportamento padrão do link
    
                // Obter o parágrafo associado à imagem clicada
                const description = link.nextElementSibling.innerText;
    
                // Definir a imagem e descrição no lightbox
                lightboxImage.src = link.href; // A imagem ampliada
                lightboxDescription.innerText = description; // A descrição
    
                // Exibir o lightbox
                lightbox.style.display = 'flex'; // Mostrar o lightbox
            });
        });
    
        // Fechar lightbox e ocultar ao clicar no botão de fechar
        closeButton.addEventListener('click', function () {
            lightbox.style.display = 'none'; // Ocultar o lightbox
        });
    
        // Fechar lightbox ao clicar fora da imagem
        lightbox.addEventListener('click', function (event) {
            if (event.target === lightbox) {
                lightbox.style.display = 'none'; // Ocultar o lightbox se o fundo for clicado
            }
        });
    });
    