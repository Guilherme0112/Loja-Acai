const url = new URLSearchParams(window.location.search);
const produto = url.get('p');
//
$(function(){    
    $('.btn-car').click(function(){
        $.ajax({
            url: 'config.php',
            type: 'POST',
            data: {
                produto: produto
            },
            success: function(e){
                 var carMsg = $('.btn-car');
                if(carMsg.val() === 'Adicionar ao Carrinho'){
                    carMsg.val('Retirar do Carrinho');
                    console.log('Success ' + e);
                } else {
                    carMsg.val('Adicionar ao Carrinho');
                }
            }, error: function(e){
                console.log('Erro ' + e);
            }
        })
    })
})
$(function(){    
    $('.btn-delete').click(function(){
        $.ajax({
            url: 'config.php',
            type: 'POST',
            data: {
                delete: produto
            },
            success: function(e){
                console.log('Success ' + e);
                window.location = "../admin/posts/posts.php";
            }, error: function(e){
                console.log('Erro ' + e);
            }
        })
    })
})