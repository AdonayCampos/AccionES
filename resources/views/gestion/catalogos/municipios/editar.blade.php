@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar Municipio</h1>

        <form action="/gestiones/cat/municipios/edit/{{ $municipio->mun_id }}" method="POST" class="mx-auto"
            style="max-width: 400px;">
            @csrf
            @method('PUT')
            <input type="hidden" id="mun_id_dep" name="mun_id_dep" value="{{ $municipio->mun_id_dep }}" />
            <input type="hidden" id="mun" name="mun" value="{{ $municipio->mun_id }}" />
            <div class="form-group">
                <label for="dep_nombre">Nombre del Departamento:</label>
                <input type="text" class="form-control mb-2" id="dep_nombre" name="dep_nombre"
                    value="{{ $municipio->departamento->dep_nombre }}" disabled>
                @error('dep_nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mun_nombre">Nombre del Municipio:</label>
                <input type="text" class="form-control mb-2" id="mun_nombre" name="mun_nombre" required
                    value="{{ $municipio->mun_nombre }}">
                @error('mun_nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mun_estado">Estado:</label>
                <select class="form-control mb-2" id="mun_estado" name="mun_estado">
                    <option value="1" {{ $municipio->mun_estado == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $municipio->mun_estado == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="form-group mt-4 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="/gestiones/cat/municipios/listar/{{ $municipio->mun_id_dep }}" class="btn btn-secondary">Regresar
                    al
                    listado</a>
            </div>
        </form>

    </div>
@endsection
