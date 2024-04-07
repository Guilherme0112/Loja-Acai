function logar(){

    var name = document.getElementById('email').value
    var password = document.getElementById('pass').value
    var msg = document.getElementById('msg')

    if (name == "teste" && password == "teste") {

        location.href = '../home/home.html'

    } else {

        msg.innerHTML = 'Você não tem uma conta ou você inseriu os dados incorretos.'
    }


    
}
function back(){

    location.href = '../index.html'
}