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

        @guest
            <a href="{{ route('login') }}">
                <button class="login-btn">Iniciar sesión</button>
            </a>
        @endguest

        @auth
        <div class="user-name">
            <a href="{{ route('cards.index') }}">
                <button class="login-btn">Métodos de pago</button>
            </a>
            <a href="{{ route('login') }}">
                <button class="login-btn">Cerrar sesión</button>
            </a>
        </div>
        @endauth

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
                    <td><img src="{{ asset($item['imagen']) }}" width="80"></td>
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
            <button id="pagoBtn" class="boton-pago">Proceder con el pago</button>
        </div>

    @else
        <p>No tienes productos en el carrito.</p>
    @endif

    <!-- Overlay -->
    <div class="overlay hidden" id="overlay">

        <div class="payment-container" id="paymentBox">

            <h2>Detalles de Pago</h2>

            <div class="form-group">
                <label for="payment_method">Método de pago</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="card">Usar tarjeta guardada</option>
                    <option value="manual">Ingresar manualmente</option>
                    <option value="oxxo">Oxxo Pay</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

           <form action="{{ route('carrito.comprar') }}" method="POST" class="payment-form">
    @csrf

    <!-- Tarjetas guardadas -->
    @auth
    @if(count($cards) > 0)
        <div class="form-group">
            <label for="card_id">Selecciona una tarjeta</label>
            <select name="card_id" id="card_id" required>
                <option value="">Selecciona una tarjeta</option>
                @foreach($cards as $card)
                    <option value="{{ $card->id }}">
                        {{ $card->name_on_card }} — **** **** **** {{ substr($card->card_number, -4) }}
                    </option>
                @endforeach
            </select>
        </div>
    @else
        <p>No tienes tarjetas guardadas.</p>
        <a href="{{ route('cards.index') }}" class="btn">Agregar método de pago</a>
        <br><br>
        <button type="button" disabled class="btn-pay-disabled">No puedes pagar sin una tarjeta guardada</button>
        @endauth
        @endif

    <!-- Dirección -->
    <h3>Dirección de Envío</h3>

    <div class="form-group">
        <label for="full-name">Nombre completo</label>
        <input type="text" id="full-name" name="full-name" required>
    </div>

    <div class="form-group">
        <label for="address">Dirección</label>
        <input type="text" id="address" name="address" required>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="city">Ciudad</label>
            <input type="text" id="city" name="city" required>
        </div>
        <div class="form-group">
            <label for="zip">Código Postal</label>
            <input type="text" id="zip" name="zip" required>
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

    <!-- BOTÓN -->
    @if(count($cards) > 0)
        <button type="submit" class="btn-pay">Proceder al pago</button>
    @endif

</form>

        </div>

    </div>

</main>

<script>
    // Abrir modal
    document.getElementById('pagoBtn').addEventListener('click', () => {
        document.getElementById('overlay').classList.remove('hidden');
    });

    // Cerrar modal
    document.getElementById('overlay').addEventListener('click', (e) => {
        if (e.target.id === 'overlay') {
            document.getElementById('overlay').classList.add('hidden');
        }
    });

    const methodSelect = document.getElementById("payment_method");
    const savedCards = document.getElementById("saved-cards-box");
    const manualCard = document.getElementById("manual-card-box");
    const cardId = document.getElementById("card_id");

    methodSelect.addEventListener("change", () => {
        if (methodSelect.value === "card") {
            savedCards.style.display = "block";
            manualCard.style.display = "none";

            // limpiar manual
            document.getElementById("card-name").value = "";
            document.getElementById("card-number").value = "";
            document.getElementById("exp-date").value = "";
            document.getElementById("cvv").value = "";

        } else if (methodSelect.value === "manual") {
            savedCards.style.display = "none";
            manualCard.style.display = "block";

            // remover card_id para que no se envíe
            if (cardId) cardId.name = "";
        } else {
            savedCards.style.display = "none";
            manualCard.style.display = "none";
        }
    });

    methodSelect.dispatchEvent(new Event("change"));
</script>

</body>
</html>
