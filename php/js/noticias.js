$(document).ready(function(){
    // Load noticias on page load
    loadNoticias();

    // Function to load noticias
    function loadNoticias() {
        $.ajax({
            type: "POST",
            url: "noticias.php",
            data: {},
            beforeSend: function() {
               // $(".noticias").html("Loading...");
            },
            success: function(data) {
                var html = '<ul id="lista-noticias">';
                $.each(data, function(index, newsItem) {
                    html += '<li>';
                    html += '<h2>' + newsItem.title + '</h2>';
                    html += '<p>' + newsItem.content + '</p>';
                    html += '<a href="#" class="noticia-link" data-id="' + newsItem.id + '">' + newsItem.title + '</a>';
                    if(newsItem.deleteLink){
                        html += '<button class="eliminar-link" data-id= "'+ newsItem.id +'">Eliminar</button>';
                    }
                    html += '</li>';
                });
                html += '</ul>';
                $('#noticias').html(html);
            },
            error: function() {
                alert("Erro ao carregar as noticias");
            }
        });
    }

    // Function to load a single noticia
    function carregarNoticia(id) {
        $.ajax({
            type: "POST",
            url: "carregar_noticias.php",
            data: {id: id},
            beforeSend: function() {
                $(".noticia").html("Loading...");
            },
            success: function(data) {
                $('#corpo-noticia').html(data);
                $('#corpo-noticia').attr('contenteditable', 'true');
            },
            error: function() {
                alert("Erro ao carregar a noticia.");
            }
        });
    }

    // Noticia link click event
    $(document).on('click', '.noticia-link', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        carregarNoticia(id);
    });

    // Edit noticias link click event
    $(document).on('click', '.editar-link', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "editar_noticia.php",
            data: {id: id},
            success: function(data) {
                $(".editar-noticia").html(data);
                $(".editar-noticia").modal('show');
            }
        });
    });

    // Delete noticias link click event
    $(document).on('click', '.eliminar-link', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if (confirm("¿Seguro que deseas eliminar esta noticia?")) {
            $.ajax({
                type: "POST",
                url: "eliminar_noticia.php",
                data: {id: id},
                success: function(data) {
                    loadNoticias();
                }
            });
        }
    });

    // Save changes click event
    $(document).on('click', '.save-changes', function() {
        var updatedContent = $('#corpo-noticia').html();
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "salvar_noticia.php",
            data: { id: id, content: updatedContent },
            success: function(data) {
                alert("Notícia atualizada com sucesso!");
            },
            error: function() {
                alert("Erro ao atualizar notícia.");
            }
        });
    });
});