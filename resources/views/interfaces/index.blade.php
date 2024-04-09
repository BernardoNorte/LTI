<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaces do Dispositivo</title>
</head>
<body>
    <h1>Interfaces do Dispositivo</h1>

    <ul>
        @foreach($interfaces as $interface)
            <li>{{ $interface['name'] }}</li>
        @endforeach
    </ul>
</body>
</html>
