
    var MainImg;
    var thumbnail_img;

    function setup() {
        MainImg = document.getElementById('img-principal');
        thumbnail_img = document.getElementsByClassName('small-img');
    }

    function Mostrar_Imagem(index) {
        MainImg.src = thumbnail_img[index].src;
    }

    function Imagem_Anterior() {
        var currentIndex = Array.from(thumbnail_img).findIndex(function(img) {
            return img.src === MainImg.src;
        });
        if (currentIndex > 0) {
            MainImg.src = thumbnail_img[currentIndex - 1].src;
        }
    }

    function Proxima_Imagem() {
        var currentIndex = Array.from(thumbnail_img).findIndex(function(img) {
            return img.src === MainImg.src;
        });
        if (currentIndex < thumbnail_img.length - 1) {
            MainImg.src = thumbnail_img[currentIndex + 1].src;
        }
    }

    function Btn_Favorito() {
        var favBtn = document.querySelector('.fav-btn');
        favBtn.classList.toggle('active'); // Alternar a classe "active" no botão de favorito
    }

    function Diminuir_Valor() {
        var input = document.getElementById('btn-input');
        var currentValue = parseInt(input.value, 10);
        if (!isNaN(currentValue) && currentValue > 1) {
            input.value = currentValue - 1;
        }
    }

    function Aumentar_Valor() {
        var input = document.getElementById('btn-input');
        var currentValue = parseInt(input.value, 10);
        if (!isNaN(currentValue)) {
            input.value = currentValue + 1;
        }
    }

    // Chamada da função setup() para inicializar as variáveis
    document.addEventListener('DOMContentLoaded', function() {
        setup();
    });
    