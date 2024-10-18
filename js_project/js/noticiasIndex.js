



function news() {
    var url = 'https://www.rtp.pt/noticias/rss';
    $.ajax({
        url:"https://api.rss2json.com/v1/api.json?rss_url=" + url,
        type: 'GET',
        success: function (data) {
            var objeto_json = (data);
            // ler o conteúdo
            var frase = "";
            
            for (var i = 0; i < objeto_json.items.length; i++){
                frase = frase + "Título: <b>" + objeto_json.items[i].title + "</b><br/>";
                frase = frase + objeto_json.items[i].description + "<br/>";
                }
            $("#boxNews").html(frase);
        },
        error: function (xhr, status) {
            alert('Ocorreu um erro.');
        }
        
    });
    var boxNews = document.getElementById("boxNews");
    boxNews.style.overflow = "hidden";
    boxNews.style.overflow = boxNews.style.overflow === "hidden" ? "scroll" : "hidden";
    boxNews.style.backgroundColor = "white";
} 

