
<head>
    <link rel="stylesheet" href="{{ asset('css/metodo.css') }}">
</head>
<div class="edit-card-container">

    <h1>Editar tarjeta</h1>

    <a class="back-link" href="{{ route('cards.index') }}">← Volver a mis tarjetas</a>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cards.update', $card->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre en la tarjeta:</label>
        <input type="text" name="name_on_card" value="{{ old('name_on_card', $card->name_on_card) }}" required>

        <label>Número de tarjeta:</label>
        <input type="text" name="card_number" value="{{ old('card_number', $card->card_number) }}" required>

        <label>Fecha de expiración:</label>
        <input type="text" name="exp_year" value="{{ old('exp_year', $card->expiry_date) }}" required>

        <button type="submit">Guardar cambios</button>
    </form>

</div>
