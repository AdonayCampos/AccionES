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

        .btn-generar-pdf {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
    <div class="container">
        <h1>Reporte de Responsables por Gestiones</h1>

        <div class="filter-panel">
            <h2>Filtros</h2>

            <form action="/reportes/resxges" method="GET">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gestion">Gestiones:</label>
                            <select class="form-control" id="gestion" name="gestion[]" multiple>
                                <option value="">Seleccione uno o varios Gestiones...</option>
                                @foreach ($gestiones as $item)
                                    <option value="{{ $item->ges_id }}">{{ $item->ges_nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <br />
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                            <a class="btn btn-success" href="/reportes/resxges" class="btn btn-secondary">Limpiar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <h2 class="results-heading">Resultados</h2>

        <div class="row">
            <div class="form-group">
                <a href="/reportes/pdf/resxges/{{ base64_encode(json_encode($responsables)) }}" target="_blank"
                    id="btn-generar-pdf" class="btn btn-primary btn-generar-pdf">Generar
                    PDF</a>
            </div>
            @foreach ($responsables as $responsable)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $responsable->persona->per_primer_nombre }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{ $responsable->gestion->ges_nombre }}
                            </h6>
                            <p class="card-text">
                                @if ($responsable->reg_cargo == 1)
                                    Administrador/a
                                @else
                                    Responsable
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
        $(document).ready(function() {
            // Ocultar el enlace "Generar PDF" al cargar la página
            $('#btn-generar-pdf').hide();

            // Verificar si hay al menos una <div> con la clase "card"
            if ($('.card').length > 0) {
                // Mostrar el enlace "Generar PDF"
                $('#btn-generar-pdf').show();
            }
        });
    </script>
@endsection
