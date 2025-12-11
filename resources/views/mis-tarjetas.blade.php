<head>
     <link rel="stylesheet" href="{{ asset('css/tarjetas.css') }}">
</head>

<h1>Mis tarjetas</h1>
<div class="cont">

    <a href="{{ route('crear-tarjeta') }}">Agregar tarjeta</a>
    <a href="{{ route('productos.index')}}" class="return">
                        <button class="login-btn">Regresar</button>
                    </a>
</div>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<ul>
@foreach ($cards as $card)
    <li>
        {{ $card->name_on_card }} — {{ $card->card_number }}
        <a href="{{ route('cards.edit', $card->id) }}">Editar</a>

        <form action="{{ route('cards.destroy', $card->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    </li>
@endforeach
</ul>


