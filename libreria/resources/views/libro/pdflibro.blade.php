<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libros</title>
    <!-- Styles -->
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <h2>Lista de libros</h2>
    <hr>
    <table class="table table-striped table-hover" >
        <thead class="thead">
            <tr>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Fecha ingreso</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $libros->nombre }}</td>
                <td>{{ $libros->categoria->nombre }}</td>
                <td>{{ $libros->created_at->format('Y-m-d') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>