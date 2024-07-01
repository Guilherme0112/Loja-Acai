function vali(){
    var endereco = document.getElementById('address');
    var bairro = document.getElementById('bairro');
    var number = document.getElementById('number');
    var rua = document.getElementById('rua');
    if(endereco.value.length > 200){
        endereco.style.outline = "2px solid red";
        return false;
    } else {
        endereco.style.outline = "none";
    }
    if(bairro.value.length < 3 || bairro.value.length > 50){
        bairro.style.outline = "2px solid red";
        return false;
    } else{
        bairro.style.outline = "2px solid red";
    }
    if(number.value.length === 0){
        number.style.outline = "2px solid red";
        return false;
    } else {
        number.style.outline = "none";
    }
    if(rua.value.length < 3 || rua.value.length > 50){
        rua.style.outline = "2px solid red";
        return false;
    } else {
        rua.style.outline = "none";
    }
}
document.addEventListener('DOMContentLoaded', function(){
    var endereco = document.getElementById('address');
    var msgAddress = document.getElementById('enderecoError');
   endereco.addEventListener('input', function(){
        var enderecoV = endereco.value.length;
        msgAddress.innerHTML = enderecoV + "/200";
        if(enderecoV > 200){
            endereco.style.color = "Red";
            msgAddress.style.color = "Red";
        } else {
            endereco.style.color = "black";
            msgAddress.style.color = "white";
        }
    })
    var bairro = document.getElementById('bairro');
    var msgBairro = document.getElementById('bairroError');
   bairro.addEventListener('input', function(){
        var bairroV = bairro.value.length;
        msgBairro.innerHTML = bairroV + "/200";
        if(bairroV > 50 || bairroV < 3){
            bairro.style.color = "Red";
            msgBairro.style.color = "Red";
        } else {
            bairro.style.color = "black";
            msgBairro.style.color = "white";
        }
    })
    var rua = document.getElementById('rua');
    var msgRua = document.getElementById('ruaError');
   rua.addEventListener('input', function(){
        var ruaV = rua.value.length;
        msgRua.innerHTML = ruaV + "/50";
        if(ruaV > 50 || ruaV < 3){
            rua.style.color = "Red";
            msgRua.style.color = "Red";
        } else {
            rua.style.color = "black";
            msgRua.style.color = "white";
        }
    })
})