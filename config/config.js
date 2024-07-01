document.addEventListener('DOMContentLoaded', function(){
    var cep = document.getElementById('cep');   
    cep.addEventListener('input', function(){
        var cepV = cep.value;
        cepV = cepV.replace(/^(\d{3})(\d{5})$/, '$1-$2');
        cep.value = cepV;
    });
    var tel = document.getElementById('tel');
    tel.addEventListener('input', function(){
        var telV = tel.value;
        telV = telV.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
        tel.value = telV;
    });
    var excluir = document.getElementById('delete');
    excluir.addEventListener('click', function(e){
        const c = confirm('Você deseja realmente excluir esta conta?');
        if(!c){
            e.preventDefault();
        }
    })
});
function vali(){
    var nome = document.getElementById('nome');
    var tel = document.getElementById('tel');
    var cep = document.getElementById('cep');
    if(nome.value.length > 2 && nome.value.length < 55){
        nome.style.outline = "none";
    } else {
        nome.style.outline = "2px solid red";
        return false;
    }
    if(tel.value.length === 15){
        tel.style.outline = "none";
    } else {
        tel.style.outline = "2px solid red";
        return false;
    }
    if(cep.value.length === 9){
        cep.style.outline = "none";
    } else {
        cep.style.outline = "2px solid red";
        return false;
    }
}
