function back(){
    location.href = '../index.php';
}

function vali(){
    var nome = document.getElementById('name');
    var phone = document.getElementById('phone');
    var cep = document.getElementById('cep');
    var senha = document.getElementById('password');
    if(nome.value.length <= 2 || nome.value.length >= 55){
        nome.style.outline = "2px solid red";
        document.getElementById('msgName').innerHTML = "O nome precisa no mínimo 3 e no máximo 55 caracteres";
        return false;
    } else {
        nome.style.outline = "none";
        document.getElementById('msgName').innerHTML = "";
        
    }
    if(phone.value.length != 12){
        phone.style.outline = "2px solid red";
        document.getElementById('msgPhone').innerHTML = "O número celular precisa estar no modelo: 00 000000000";
        return false;
    } else {
        phone.style.outline = "none";
        document.getElementById('msgPhone').innerHTML = "";
        
    }
    if(cep.value.length != 9){
        cep.style.outline = "2px solid red";
        document.getElementById('msgCep').innerHTML = "O CEP deve ter 8 dígitos. Ex: 000-00000";
        return false;
    } else {
        cep.style.outline = "none";
        document.getElementById('msgCep').innerHTML = "";
        
    }
    if(senha.value.length <= 4 || senha.value.length > 16){
        senha.style.outline = "2px solid red";
        document.getElementById('msgPass').innerHTML = "A senha precisa no mínimo 5 e no máximo 16 caracteres";
        return false;
    } else {
        senha.style.outline = "none";
        document.getElementById('msgPass').innerHTML = "";
        
    }
    
}