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
