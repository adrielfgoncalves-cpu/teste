<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css'])

    <title>Projeto-Teste</title>
</head>

<body>
    <div class="main-container">
        <header class="header">
            <div class="content-header">
                <ul class="list-nav-link"> 
                     <h2 class="title-logo"><a href="/">Início</a></h2>
                </ul>
                <ul class="list-nav-link">                
                     <h2 class="title-logo"><a href="{{ route('user.list') }}">Listar</a></h2>
                </ul>
            </div>
        </header>
        @yield('content')
    </div>
</body>

</html>
