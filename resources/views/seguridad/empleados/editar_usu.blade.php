@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar Usuario</h1>

        <form action="/empleado/usuario/edit/{{ $usuario->usu_id }}" method="POST" class="mx-auto" style="max-width: 400px;">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre_usu">Nombre:</label>
                <input type="hidden" id="per" name="per" value="{{ $usuario->usu_id_per }}" />
                <input type="text" disabled class="form-control mb-2" id="nombre_per" name="nombre_per"
                    value="{{ $usuario->persona->per_primer_nombre . ' ' . $usuario->persona->per_segundo_nombre . ' ' . $usuario->persona->per_primer_apellido . ' ' . $usuario->persona->per_segundo_apellido }}">
            </div>
            <div class="form-group">
                <label for="nombre_usu">Nombre de usuario:</label>
                <input type="text" class="form-control mb-2" id="nombre_usu" name="nombre_usu"
                    value="{{ $usuario->usu_usuario }}">
            </div>

            <div class="form-group">
                <label for="rol">Rol:</label>
                <select class="form-control mb-2" id="rol" name="rol">
                    @if (Auth::user()->usu_rol == 1)
                        <option value="1" {{ $usuario->usu_rol == 1 ? 'selected' : '' }}>Administrador</option>
                        <option value="2" {{ $usuario->usu_rol == 2 ? 'selected' : '' }}>Responsable</option>
                    @endif
                    <option value="3" {{ $usuario->usu_rol == 3 ? 'selected' : '' }}>Ciudadano</option>
                </select>
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <select class="form-control mb-2" id="estado" name="estado">
                    <option value="1" {{ $usuario->usu_estado == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $usuario->usu_estado == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="modificar_contrasena" name="modificar_contrasena"
                    value="1" onchange="togglePassword()">
                <label class="form-check-label" for="modificar_contrasena">Modificar Contraseña</label>
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control mb-2" id="contrasena" name="contrasena" disabled>
            </div>

            <div class="form-group mt-4 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="/empleado" class="btn btn-secondary">Regresar al listado</a>
            </div>
        </form>

    </div>
@endsection

@section('scripts')
    <script>
        function togglePassword() {
            var modificarContrasena = document.getElementById('modificar_contrasena');
            var contrasena = document.getElementById('contrasena');

            if (modificarContrasena.checked) {
                contrasena.disabled = false;
            } else {
                contrasena.disabled = true;
            }
        }
    </script>
@endsection
