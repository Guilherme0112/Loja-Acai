function back() {

    location.href = '../login/login.html'

}

var contador = 0;
var limite = 1;

function one(){

 if ( contador < limite) {  
    let div = document.getElementById('info')
    let img = document.createElement('img')
    img.id = 'sel_1'
    img.src = 'https://www.burgerfoods.com.br/wp-content/uploads/2023/01/b7e870fe16253b03d4f5e4eca7c887cf_XL.jpg'
    div.appendChild(img)
    contador++;
} else {

}
}

function two() {

}

function tree(){


} 
  
function custom(){
    
if ( contador < limite) {

    let div = document.getElementById('info')
    let input = document.createElement('input')
    input.id = 'customJS'
    input.placeholder = 'Nos diga suas preferências'
    div.appendChild(input)
    contador++;

} else {

}
}