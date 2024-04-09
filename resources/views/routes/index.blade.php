<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotas estáticas do Dispositivo</title>
</head>
<body>
    <h1>Rotas estáticas do Dispositivo</h1>

    <ul>
        @foreach($routes as $route)
            <li>{{ $route['dst-address'] }}</li>
        @endforeach
    </ul>
</body>
</html>