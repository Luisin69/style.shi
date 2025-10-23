<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"href="">
</head>
<body>
    <div class="card">
        <h2>Registrarse</h2>
    <form method="POST" action="{{route('validar-registro')}}">
            @csrf
            <div class="form">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" required autocomplete="disable">
            </div>
            <div class="form">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwordInput" name="password" required>
            </div>
            <div class="form">
                <label for="userInput" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="userInput" name="name" required autocomplete="disable">
            </div>
            <button type="submit" class="btn">Registrarse</button>
    </div>
    </form>
</body>
</html> 