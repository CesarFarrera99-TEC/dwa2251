<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registrar Usuario</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('registrar') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>

        <label for="nombre_usuario">Nombre de usuario:</label>
        <input type="text" name="nombre_usuario" required>
        <br>

        <label for="clave">Clave:</label>
        <input type="password" name="clave" required>
        <br>

        <label for="clave_confirmation">Confirmar Clave:</label>
        <input type="password" name="clave_confirmation" required>
        <br>

        <button type="submit">Registrar</button>
    </form>

</body>
</html>
