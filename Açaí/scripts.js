function pedido(){

    location.href = './login/login.html'
}
function Password() {

    var password = document.getElementById('pass')

    if (password.type === 'password' ) {

        password.type = 'text'

    }else{

        password.type = 'password'
    }
}