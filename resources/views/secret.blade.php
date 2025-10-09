<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagina privada</title>
    <link href="">
</head>
<body>
    <div class="container">
        <header>
            <a>
                Pagina privada @auth de {{Auth::user()->name}} @endauth
            </a>
            <div>
                <a href="{{route('logout')}}"><button type="button">Salir</button>
            </div>
        </header>
    </div>
</body>
</html>