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
                @guest
                    
                <a href="{{ route('login')}}">
                    <button class="login-btn">Iniciar sesion</button>
                </a>
                @endguest

                @auth
        <div class="user-name">
           <a href="{{ route('cards.index')}}">
                    <button  class="login-btn">Metodos de pago</button>
                </a>

                <a href="{{ route('login')}}">
                    <button class="login-btn">Cerrar sesion</button>
                </a>
        </div>
    @endauth
                
                <div class="cart">
                    <a href="{{ route('carrito.index')}}">
                    <img src="{{ asset('images/cart.svg') }}" alt="Carrito" class="cart-icon">
                    <span class="cart-count">{{ session('carrito') ? array_sum(array_column(session('carrito'), 'cantidad')) : 0 }}</span>
                    </a>
                </div>
            </div>
        </header>


    <main>
        <div class="cards-container">

            @foreach ($products as $product)
            
            <div class="card">
                <div class="img-wrapper">
    <img src="{{ $product->image }}" alt="">
</div>
                <div class="card-details">
                    <span>{{$product->name}}</span>
                    <div class="card-action">
                        <span>{{$product->price}}$</span>
                        <form action="{{ route('carrito.agregar', $product->id) }}" method="POST">
                        @csrf
                        <button class="buy-button">+</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </body>
    </main>



</html> 