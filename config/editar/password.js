function vali(){
    var senha = document.getElementById('newPass');
    var rSenha = document.getElementById('rPass');
    if(senha.value.length <= 4 || senha.value.length > 16 || senha.value != rSenha.value){
        senha.style.outline = "2px solid red";
        rSenha.style.outline = "2px solid red";
        document.getElementById('msg').innerHTML = "A senhas precisam no mínimo 5 e no máximo 16 caracteres e devem ser iguais";
        return false;
    } else {
        senha.style.outline = "none";
        rSenha.style.outline = "none";
        document.getElementById('msgPass').innerHTML = "";   
    }
}
