@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Crear Usuario</h1>

        <form action="/registro/create" class="mx-auto" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="per_primer_nombre">Primer Nombre:</label>
                        <input type="text" class="form-control mb-2" id="per_primer_nombre" name="per_primer_nombre"
                            required>
                        @error('per_primer_nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="per_segundo_nombre">Segundo Nombre:</label>
                        <input type="text" class="form-control mb-2" id="per_segundo_nombre" name="per_segundo_nombre">
                        @error('per_segundo_nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="per_tercer_nombre">Tercer Nombre:</label>
                        <input type="text" class="form-control mb-2" id="per_tercer_nombre" name="per_tercer_nombre">
                        @error('per_tercer_nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="per_primer_apellido">Primer Apellido:</label>
                        <input type="text" class="form-control mb-2" id="per_primer_apellido" name="per_primer_apellido"
                            required>
                        @error('per_primer_apellido')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="per_segundo_apellido">Segundo Apellido:</label>
                        <input type="text" class="form-control mb-2" id="per_segundo_apellido"
                            name="per_segundo_apellido">
                        @error('per_segundo_apellido')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tiene_apellido_casada">¿Tiene apellido de casada/o?</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="tiene_apellido_casada"
                                name="tiene_apellido_casada">
                            <label class="form-check-label" for="tiene_apellido_casada">Sí</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="per_apellido_casado">Apellido de casada/o:</label>
                        <input type="text" class="form-control mb-2" id="per_apellido_casado" name="per_apellido_casado"
                            disabled>
                        @error('per_apellido_casado')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="per_dui">DUI:</label>
                        <input type="text" class="form-control mb-2" id="per_dui" name="per_dui"
                            data-inputmask="'mask': '99999999-9'" required>
                        <small>Ejemplo: 12345678-9</small>
                        @error('per_dui')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="departamento">Departamento de Residencia:</label>
                        <select class="form-control mb-2" id="departamento" name="departamento" required>
                            <option value="">Seleccione un departamento...</option>
                            @foreach ($dep as $item)
                                <option value="{{ $item->dep_id }}">{{ $item->dep_nombre }}</option>
                            @endforeach
                        </select>
                        @error('departamento')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="per_id_mun_residencia">Municipio de Residencia:</label>
                        <select class="form-control mb-2" id="per_id_mun_residencia" name="per_id_mun_residencia" required>
                            <option value="">Seleccione un municipio...</option>
                        </select>
                        @error('per_id_mun_residencia')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="per_direccion_residencia">Dirección de Residencia:</label>
                    <textarea class="form-control" id="per_direccion_residencia" name="per_direccion_residencia" rows="3"></textarea>
                    @error('per_direccion_residencia')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="per_fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" class="form-control mb-2" id="per_fecha_nacimiento"
                            name="per_fecha_nacimiento" max="{{ date('Y-m-d') }}">
                        @error('per_fecha_nacimiento')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usu_usuario">Nombre de usuario:</label>
                        <input type="text" autocomplete="none" class="form-control mb-2" id="usu_usuario"
                            name="usu_usuario" required>
                        @error('usu_usuario')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usu_pass">Contraseña</label>
                        <input type="password" autocomplete="none" class="form-control mb-2" id="usu_pass"
                            name="usu_pass" required>
                        @error('usu_pass')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="text-center">
                    <button class="btn btn-primary">Guardar</button>
                    <a href="/" class="btn btn-secondary">Regresar al login</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <script>
        // Obtener referencia a los selectores
        var departamentoSelector = document.getElementById('departamento');
        var municipioSelector = document.getElementById('per_id_mun_residencia');

        // Evento de cambio en el selector de departamento
        departamentoSelector.addEventListener('change', function() {
            var departamentoId = this.value;

            // Realizar solicitud AJAX para obtener los municipios correspondientes
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/registro/municipios/' + departamentoId);
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
        var tieneApellidoCasadaCheckbox = document.getElementById('tiene_apellido_casada');
        var apellidoCasadaInput = document.getElementById('per_apellido_casado');

        tieneApellidoCasadaCheckbox.addEventListener('change', function() {
            if (this.checked) {
                apellidoCasadaInput.disabled = false;
            } else {
                apellidoCasadaInput.disabled = true;
                apellidoCasadaInput.value = '';
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#per_dui').inputmask();
        });
    </script>
@endsection
