@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar Departamento</h1>

        <form action="/gestiones/cat/departamentos/edit/{{ $departamento->dep_id }}" method="POST" class="mx-auto"
            style="max-width: 400px;">
            @csrf
            @method('PUT')
            <input type="hidden" id="dep" name="dep" value="{{ $departamento->dep_id }}" />
            <div class="form-group">
                <label for="dep_nombre">Nombre del Departamento:</label>
                <input type="text" class="form-control mb-2" id="dep_nombre" name="dep_nombre"
                    value="{{ $departamento->dep_nombre }}" required>
                @error('dep_nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="dep_estado">Estado:</label>
                <select class="form-control mb-2" id="dep_estado" name="dep_estado">
                    <option value="1" {{ $departamento->dep_estado == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $departamento->dep_estado == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="form-group mt-4 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="/gestiones/cat/departamentos" class="btn btn-secondary">Regresar al listado</a>
            </div>
        </form>

    </div>
@endsection
