@extends('layouts.app')

@section('content')
    <style>
        .filter-panel {
            background-color: #f5f5f5;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .filter-panel h2 {
            margin-top: 0;
        }

        .results-heading {
            margin-top: 30px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }

        .card-text {
            margin-bottom: 5px;
        }

        .form-control[multiple] {
            height: auto;
        }

        .form-control[multiple] option {
            padding: 6px 12px;
        }
    </style>
    <div class="container">
        <h1>Reporte General de Gestiones (aprobados y en ejecución)</h1>

        <div class="filter-panel">
            <h2>Filtros</h2>

            <form action="/reportes" method="GET">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="departamento">Departamentos donde se imparte:</label>
                            <select class="form-control" id="departamento" name="departamento[]" multiple required>
                                <option value="">Seleccione uno o varios departamentos...</option>
                                @foreach ($departamentos as $item)
                                    <option value="{{ $item->dep_id }}">{{ $item->dep_nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="municipio">Municipios donde se imparte:</label>
                            <select class="form-control" id="municipio" name="municipio[]" multiple required>
                                <option value="">Seleccione uno o varios municipios...</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <br />
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <h2 class="results-heading">Resultados</h2>

        <div class="row">
            @foreach ($gestiones as $gestion)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $gestion->ges_nombre }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                @if ($gestion->ges_tipo_gestion == 1)
                                    Curso
                                @elseif($gestion->ges_tipo_gestion == 2)
                                    Evento
                                @else
                                    Proyecto
                                @endif
                            </h6>
                            <p class="card-text">{{ $gestion->ges_descripcion }}</p>
                            <p class="card-text">
                                {{ $gestion->municipio->mun_nombre }},
                                {{ $gestion->municipio->departamento->dep_nombre }}
                            </p>
                            <p class="card-text">
                                @if ($gestion->ges_fecha_inicio)
                                    {{ $gestion->ges_fecha_inicio->format('d/m/Y') }}
                                @endif
                                -
                                @if ($gestion->ges_fecha_fin)
                                    {{ $gestion->ges_fecha_fin->format('d/m/Y') }}
                                @endif
                            </p>
                            <p class="card-text">Num de Beneficiados: {{ $gestion->ges_num_benef }}</p>
                            <p class="card-text">
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
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Obtener referencia a los selectores
        var departamentoSelector = document.getElementById('departamento');
        var municipioSelector = document.getElementById('municipio');
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Evento de cambio en el selector de departamento
        departamentoSelector.addEventListener('change', function() {
            var departamentoIds = Array.from(this.selectedOptions).map(option => option.value);

            // Realizar solicitud AJAX para obtener los municipios correspondientes
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/obtenermunicipios');
            xhr.setRequestHeader('X-CSRF-TOKEN', token);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var municipios = JSON.parse(xhr.responseText);

                    // Limpiar los municipios actuales
                    municipioSelector.innerHTML = '';

                    // Agregar las nuevas opciones de municipios
                    municipios.forEach(function(municipio) {
                        var option = document.createElement('option');
                        option.value = municipio.mun_id;
                        option.textContent = municipio.mun_nombre;
                        municipioSelector.appendChild(option);
                    });
                }
            };

            // Enviar los IDs de los departamentos seleccionados como datos de la solicitud POST
            xhr.send(JSON.stringify({
                departamentos: departamentoIds
            }));
        });
    </script>
@endsection
