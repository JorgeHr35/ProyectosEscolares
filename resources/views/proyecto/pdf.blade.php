<!DOCTYPE html>
<html>
<head>
    <title>Proyectos</title>
    <style>
        /* Puedes personalizar el estilo del PDF aquí */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Pendientes</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Materias</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Fecha Entrega</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectosPendientes as $proyecto)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $proyecto->materia->nombre}}</td>
                    <td>{{ $proyecto->titulo }}</td>
                    <td>{{ $proyecto->descripcion }}</td>
                    <td>{{ \Carbon\Carbon::parse($proyecto->fecha_entrega)->format('d/m/Y') }}</td>
                    <td>{{ $proyecto->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Completados</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Materias</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Fecha Entrega</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectosCompletados as $proyecto)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $proyecto->materia->nombre}}</td>
                    <td>{{ $proyecto->titulo }}</td>
                    <td>{{ $proyecto->descripcion }}</td>
                    <td>{{ \Carbon\Carbon::parse($proyecto->fecha_entrega)->format('d/m/Y') }}</td>
                    <td>{{ $proyecto->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>