<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Gestiones por estado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .report-heading {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            vertical-align: middle;
        }

        .table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        @media print {
            .container {
                box-shadow: none;
            }

            .table td,
            .table th {
                padding: 6px;
            }

            .report-heading {
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="report-heading">
            <img src="{{ public_path('img/accionES.png') }}" alt="Logo de la empresa" class="logo">
            <h2 style="font-size: 20px;">Reporte de Gestiones por estado</h2>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="125px">Nombre</th>
                    <th>Tipo de Gestión</th>
                    <th>Descripción</th>
                    <th>Municipio</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th width="25px">N de Beneficiados</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gestiones as $gestion)
                    <tr>
                        <td>{{ $gestion->ges_nombre }}</td>
                        <td>
                            @if ($gestion->ges_tipo_gestion == 1)
                                Curso
                            @elseif($gestion->ges_tipo_gestion == 2)
                                Evento
                            @else
                                Proyecto
                            @endif
                        </td>
                        <td>{{ $gestion->ges_descripcion }}</td>
                        <td>{{ $gestion->municipio->mun_nombre }},
                            {{ $gestion->municipio->departamento->dep_nombre }}</td>
                        <td>
                            @if ($gestion->ges_fecha_inicio)
                                {{ $gestion->ges_fecha_inicio->format('d/m/Y') }}
                            @endif
                        </td>
                        <td>
                            @if ($gestion->ges_fecha_fin)
                                {{ $gestion->ges_fecha_fin->format('d/m/Y') }}
                            @endif
                        </td>
                        <td>{{ $gestion->ges_num_benef }}</td>
                        <td>
                            @if ($gestion->ges_estado == 1)
                                Pendiente de aprobar
                            @elseif ($gestion->ges_estado == 2)
                                Aprobado
                            @elseif ($gestion->ges_estado == 3)
                                En ejecución
                            @elseif ($gestion->ges_estado == 4)
                                Finalizado
                            @else
                                Inactivo
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
