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

    <main>
    <h2>Tu carrito</h2>

    @if(count($carrito) > 0)
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Imagen</th>
                    <th class="cantidad">Cantidad</th>
                    <th class="precio">Precio</th>
                    <th class="subtotal">Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $id => $item)
                <tr>
                    <td>{{ $item['nombre'] }}</td>
                    <td><img src="{{ asset($item['imagen']) }}" alt="{{ $item['nombre'] }}" width="80"></td>
                    <td class="cantidad">{{ $item['cantidad'] }}</td>
                    <td class="precio">${{ number_format($item['precio'], 2) }}</td>
                    <td class="subtotal">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                    <td><a class="eliminar" href="{{ route('carrito.eliminar', $id) }}">✖</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <strong>Total:</strong> ${{ number_format($total, 2) }}
        </div>

        <div class="acciones">
            <form action="{{ route('carrito.comprar') }}" method="POST">
            @csrf
            <button class="boton-pago">Proceder con el pago</button>
        </div>
    @else
        <p>No tienes productos en el carrito.</p>
    @endif
    </main>
    </body>

</html>