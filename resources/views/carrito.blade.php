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
            <!--<form action="{{ route('carrito.comprar') }}" method="POST"> -->
            @csrf
            <button id="pagoBtn" class="boton-pago">Proceder con el pago</button>
        </div>
    @else
        <p>No tienes productos en el carrito.</p>
    @endif
   <!-- Fondo oscuro -->
<div class="overlay hidden" id="overlay">
  <!-- Caja del pago -->
  <div class="payment-container">
    <h2>Detalles de Pago</h2>

    <form action="{{ route('carrito.comprar') }}" method="POST" class="payment-form">
      @csrf
        <h3>Dirección de Envío</h3>
      <div class="form-group">
        <label for="full-name">Nombre completo</label>
        <input type="text" id="full-name" name="full-name" placeholder="Juan Pérez" required>
      </div>

      <div class="form-group">
        <label for="address">Dirección</label>
        <input type="text" id="address" name="address" placeholder="Calle 123, Colonia Centro" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="city">Ciudad</label>
          <input type="text" id="city" name="city" placeholder="Ciudad de México" required>
        </div>
        <div class="form-group">
          <label for="zip">Código Postal</label>
          <input type="text" id="zip" name="zip" placeholder="01234" required>
        </div>
      </div>

      <div class="form-group">
        <label for="country">País</label>
        <select id="country" name="country" required>
          <option value="">Selecciona un país</option>
          <option value="mx">México</option>
          <option value="us">Estados Unidos</option>
          <option value="es">España</option>
          <option value="ar">Argentina</option>
        </select>
      </div>

      <h3>Información de Tarjeta</h3>
      <div class="form-group">
        <label for="card-name">Nombre en la tarjeta</label>
        <input type="text" id="card-name" name="card-name" placeholder="Juan Pérez" required>
      </div>

      <div class="form-group">
        <label for="card-number">Número de tarjeta</label>
        <input type="text" id="card-number" name="card-number" maxlength="19" placeholder="XXXX XXXX XXXX XXXX" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="exp-date">Fecha de expiración</label>
          <input type="text" id="exp-date" name="exp-date" maxlength="5" placeholder="MM/AA" required>
        </div>
        <div class="form-group">
          <label for="cvv">CVV</label>
          <input type="text" id="cvv" name="cvv" maxlength="4" placeholder="123" required>
        </div>
      </div>
      
      <button type="submit" class="btn-pay">Proceder al pago</button>
    </form>
  </div>
</div>

    </main>
    <script>
        document.getElementById('pagoBtn').addEventListener('click', function () {
            const messageDiv = document.getElementById('payment-box');
            document.getElementById('overlay').classList.remove('hidden');
            messageDiv.style.display = 'block';
        });
    </script>
    </script>
    </body>

</html>