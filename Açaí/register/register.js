function back(){

    location.href = '../index.html'

}

document.getElementById('box').addEventListener("submit", function(event) {
    event.preventDefault(); // Previne o formulário de ser enviado da maneira padrão
   
    var formData = new FormData(document.getElementById('box'));
    
    fetch('./Dataabase/app.py', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.ok) {
            console.log('Dados enviados com sucesso para o Python!');
        } else {
            console.error('Erro ao enviar os dados para o Python.');
        }
    }).catch(error => {
        console.error('Ocorreu um erro ao enviar os dados:', error);
    });
});
