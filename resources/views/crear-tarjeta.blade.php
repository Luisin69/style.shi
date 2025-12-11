<head>
    <link rel="stylesheet" href="{{ asset('css/create-card.css') }}">
</head>

<a href="{{ route('productos.index')}}">

    <button class="return" type="submit" >Regresar</button>
</a>
<h1>Agregar tarjeta</h1>

<form action="{{ route('cards.store') }}" method="POST">
    @csrf

    <label>Nombre en la tarjeta</label>
    <input type="text" name="name_on_card">

    <label>Número</label>
    <input type="text" name="card_number">

    <label>Expiración (MM/YY)</label>
    <input type="text" name="expiry_date">

    <label>CVV</label>
    <input type="text" name="cvv">

    <button type="submit">Guardar</button>
</form>

