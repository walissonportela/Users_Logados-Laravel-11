<!DOCTYPE html>
<html lang="EN">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>Celke - Administrativo</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </head>
    <body>

        <div class="container mt-5">
            <h2 class="text-center mb-4">Dashboard</h2>
        
            <div class="alert alert-info text-center">
                <strong>Quantidade de usuários online logado:</strong> 
                <span id="quantidadeUsuarioOnlineLogado" class="font-weight-bold">{{ $activeUsers }}</span>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('login.destroy') }}" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
            
        </div>     

        {{-- Incluir o arquivo JS --}}
        <script src="{{asset('js/custom.js')}}">/</script>
               
        
    </body>
</html>