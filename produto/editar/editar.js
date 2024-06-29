function vali(){
    var nome = document.getElementById('nome');
    var preco = document.getElementById('preco');
    var descricao = document.getElementById('descricao');
    if(nome.value.length < 3 || nome.value.length > 50){
        nome.style.outline = "2px solid red";
        return false;
    } else {
        nome.style.outline = "none";
    }
    if(descricao.value.length > 300){
        descricao.style.outline = "2px solid red";
        return false;
    } else {
        descricao.style.outline = "none";
    }
}

document.addEventListener('DOMContentLoaded', function(){
    const fileInput = document.querySelector('#photo')
        const imagePreview = document.getElementById('img')

        fileInput.addEventListener('change', function() {
            imagePreview.style.maxWidth = "200px";
            imagePreview.style.maxHeight = "200px";
            imagePreview.style.outline = "2px solid white";
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    })
