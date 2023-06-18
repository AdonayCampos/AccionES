@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar Gestión</h1>

        <form action="/gestiones/edit/{{ $gestion->ges_id }}" class="mx-auto" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <input type="hidden" id="ges" name="ges" value="{{ $gestion->ges_id }}" />
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ges_nombre">Nombre:</label>
                        <input type="text" class="form-control mb-2" id="ges_nombre" name="ges_nombre"
                            value="{{ $gestion->ges_nombre }}" required>
                        @error('ges_nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ges_descripcion">Descripción:</label>
                        <textarea class="form-control" id="ges_descripcion" name="ges_descripcion" rows="3">{{ $gestion->ges_descripcion }}</textarea>
                        @error('ges_descripcion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ges_tipo_gestion">Tipo de gestión:</label>
                        <select class="form-control mb-2" id="ges_tipo_gestion" name="ges_tipo_gestion" required>
                            <option value="">Seleccione un tipo...</option>
                            <option value="1" {{ $gestion->ges_tipo_gestion == 1 ? 'selected' : '' }}>Curso</option>
                            <option value="2" {{ $gestion->ges_tipo_gestion == 2 ? 'selected' : '' }}>Evento</option>
                            <option value="3" {{ $gestion->ges_tipo_gestion == 3 ? 'selected' : '' }}>Proyecto</option>
                        </select>
                        @error('ges_tipo_gestion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ges_num_benef">Número de beneficiados:</label>
                        <input type="number" pattern="[0-9]+" value="{{ $gestion->ges_id }}" class="form-control mb-2"
                            id="ges_num_benef" name="ges_num_benef" required>
                        @error('ges_num_benef')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="departamento">Departamento donde se impartirá:</label>
                        <select class="form-control mb-2" id="departamento" name="departamento" required>
                            @foreach ($dep as $item)
                                <option value="{{ $item->dep_id }}"
                                    {{ $item->dep_id == $gestion->municipio->mun_id_dep ? 'selected' : '' }}>
                                    {{ $item->dep_nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('departamento')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ges_id_mun">Municipio donde se impartirá:</label>
                        <select class="form-control mb-2" id="ges_id_mun" name="ges_id_mun" required>
                            @foreach ($municipios as $municipio)
                                <option value="{{ $municipio->mun_id }}"
                                    {{ $municipio->mun_id == $gestion->ges_id_mun ? 'selected' : '' }}>
                                    {{ $municipio->mun_nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('ges_id_mun')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ges_fecha_inicio">Fecha de Inicio:</label>
                        <input type="date" class="form-control mb-2" value="{{ $gestion->ges_fecha_inicio }}"
                            id="ges_fecha_inicio" name="ges_fecha_inicio" required>
                        @error('ges_fecha_inicio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ges_fecha_fin">Fecha de Fin:</label>
                        <input type="date" class="form-control mb-2" value="{{ $gestion->ges_fecha_fin }}" id="ges_fecha_fin"
                            name="ges_fecha_fin" required>
                        @error('ges_fecha_fin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Editar</button>
                    <a href="/gestiones/listar" class="btn btn-secondary">Regresar al listado</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Obtener referencia a los selectores
        // Obtener referencia a los selectores
        var departamentoSelector = document.getElementById('departamento');
        var municipioSelector = document.getElementById('ges_id_mun');

        // Evento de cambio en el selector de departamento
        departamentoSelector.addEventListener('change', function() {
            var departamentoId = this.value;

            // Realizar solicitud AJAX para obtener los municipios correspondientes
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/municipios/' + departamentoId);
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
            xhr.send();
        });
        var fechaInicioSelector = document.getElementById('ges_fecha_inicio');
        var fechaFinSelector = document.getElementById('ges_fecha_fin');

        // Evento de cambio en la fecha de inicio
        fechaInicioSelector.addEventListener('change', function() {
            validateFechaFin();
        });

        // Evento de cambio en la fecha de fin
        fechaFinSelector.addEventListener('change', function() {
            validateFechaFin();
        });

        // Función para validar la fecha de fin
        function validateFechaFin() {
            var fechaInicio = new Date(fechaInicioSelector.value);
            var fechaFin = new Date(fechaFinSelector.value);

            // Validar que la fecha de fin no sea igual o menor que la fecha de inicio
            if (fechaFin <= fechaInicio) {
                alert('La fecha de fin debe ser posterior a la fecha de inicio.');
                fechaFinSelector.value = '';
                fechaFinSelector.focus();
            }
        }
    </script>
@endsection
