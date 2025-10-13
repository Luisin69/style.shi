<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Style.shi</title>
        <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
    </head>

    <body>
        <header>
            <h1>Style.shi</h1>
            <div class="header-actions">
                <a href="{{ route('login')}}">
                    <button class="login-btn">Iniciar sesion</button>
                </a>
                
                <div class="cart">
                    <img src="{{ asset('images/cart.svg') }}" alt="Carrito" class="cart-icon">
                    <span class="cart-count">0</span>
                </div>
            </div>
        </header>


    <main>
    <div class="card">
        <img src="{{ $product->image }}" alt="DIO">
        <div class="card-details">
            <span>{{$product->name}}</span>
            <div class="card-action">
                <span>{{$product->price}}$</span>
                <button class="buy-button">+</button>
            </div>
        </div>
    </div>
    </body>
    </main>



</html>