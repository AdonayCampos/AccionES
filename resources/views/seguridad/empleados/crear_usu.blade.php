@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Crear Usuario</h1>

        <form action="/empleado/usuario/create" method="POST" class="mx-auto" style="max-width: 800px;">
            @csrf
            <div class="form-group">
                <label for="nombre_per">Nombre:</label>
                <input type="hidden" id="usu_id_per" name="usu_id_per" value="{{ $empleado->per_id }}" />
                <input type="text" disabled class="form-control mb-2" id="nombre_per" name="nombre_per"
                    value="{{ $empleado->per_primer_nombre . ' ' . $empleado->per_segundo_nombre . ' ' . $empleado->per_primer_apellido . ' ' . $empleado->per_segundo_apellido }}">
            </div>
            <div class="form-group">
                <label for="usu_usuario">Nombre de usuario:</label>
                <input type="text" autocomplete="none" class="form-control mb-2" id="usu_usuario" name="usu_usuario"
                    required>
                @error('usu_usuario')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="usu_rol">Rol:</label>
                <select class="form-control mb-2" id="usu_rol" name="usu_rol" required>
                    <option value="">Seleccione un rol...</option>
                    @if (Auth::user()->usu_rol == 1)
                        <option value="1">Administrador</option>
                        <option value="2">Responsable</option>
                    @endif
                    <option value="3">Ciudadano</option>
                </select>
                @error('usu_rol')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="usu_pass">Contraseña</label>
                <input type="password" autocomplete="none" class="form-control mb-2" id="usu_pass" name="usu_pass"
                    required>
                @error('usu_pass')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-4 d-flex justify-content-between">
                <button class="btn btn-primary">Guardar cambios</button>
                <a href="/empleado" class="btn btn-secondary">Regresar al listado</a>
            </div>
        </form>

    </div>
@endsection
