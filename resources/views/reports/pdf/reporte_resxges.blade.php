<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Responsables por Gestiones</title>
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
            <h2 style="font-size: 20px;">Reporte de Responsables por Gestiones</h2>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="225px">Nombre del Responsable</th>
                    <th>Gestión</th>
                    <th>Cargo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($responsables as $responsable)
                    <tr>
                        <td>{{ $responsable->persona->per_primer_nombre }}</td>
                        <td>{{ $responsable->gestion->ges_nombre }}</td>
                        <td>
                            @if ($responsable->reg_cargo == 1)
                                Administrador/a
                            @else
                                Responsable
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
