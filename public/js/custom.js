// Adicionar um listener para executar o código quando o DOM estiver totalmente carregado
document.addEventListener('DOMContentLoaded', function(){

    // Seleciona a meta tag com o nome 'csrf_token' para obter o token CSRF necessário para requisições seguras
    var csrfTokenElement = document.querySelector('meta[name="csrf-token"]');

    // Verificar se a meta tag foi encontrada
    if(csrfTokenElement){

        // Obtem o valor do token CSRF da meta tag
        var csrfToken = csrfTokenElement.getAttribute('content');

        // Define uma função que será executada em intervalos regulares
        setInterval(function(){

            // Faz uma requisição POST para a rota '/update-last-active' para atualizar a última atividade do usuário
            fetch('/update-last-active', {
                method: 'POST', // Define o método HTTP como POST
                headers: {
                    'Content-Type': 'application/json', // Define o tipo de conteúdo como JSON
                    'X-CSRF-TOKEN': csrfToken, // Inclui o token CSRF para proteger contra ataques CSRF
                },
                body: JSON.stringify({}) // Envia um corpo de requisição vázio como JSON
            })
            .then(response => response.json()) // Converte a resposta para json
            .then(data => {

                // Verifica se respota indica sucesso
                if(data.status == 'success'){

                    // Seleciona o elemento HTML com o ID 'quantidadeUsuarioOnlineLogado'
                    var quantidadeElement = document.getElementById('quantidadeUsuarioOnlineLogado');

                    // Atualiza o texto do elemento com o número de usuários ativos obtido da resposta
                    quantidadeElement.textContent = data.activeUsers;  

                } else{
                    // Loga um erro no console se a requisição falhar
                    console.error('Não atualizado a data e hora de acesso!');
                }
            })
            .catch(error => console.error('Error', error)); // Loga um erro no console se a requisição falhar 

            console.log(csrfToken);

        }, 10000); // Define o intervalo de tempo = 10000 ms = 10 segundos
    }

});