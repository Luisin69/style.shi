<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Style.shi</title>
        <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
    </head>

    <body>
        <header>
            <h1>
                <a href="{{ route('productos.index') }}" class="logo-link">Style.shi</a>
            </h1>
            <div class="header-actions">
                <a href="{{ route('login')}}">
                    <button class="login-btn">Iniciar sesion</button>
                </a>
                
                <div class="cart">
                    <img src="{{ asset('images/cart.svg') }}" alt="Carrito" class="cart-icon">
                </div>
            </div>
        </header>
    
    <main class="confirmation-container">
        <h2>{{ $mensaje }}</h2>
        <p>Recibirás un correo con los detalles de tu compra.</p>
        <a href="{{ route('productos.index') }}" class="back-btn">Volver a la tienda</a>
    </main>
    </body>
</html>