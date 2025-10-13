<html>

    <head>
        <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
    </head>

    <h1>Hola putitas</h1>
    <h2>putillo</h2>



    @foreach ($products as $product )
        
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
    @endforeach



</html>