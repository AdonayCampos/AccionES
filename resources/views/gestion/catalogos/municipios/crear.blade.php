@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Crear Municipio</h1>

        <form action="/gestiones/cat/municipios/create" method="POST" class="mx-auto" style="max-width: 800px;">
            @csrf
            <input type="hidden" id="mun_id_dep" name="mun_id_dep" value="{{ $departamento->dep_id }}" />
            <div class="form-group">
                <label for="nombre_dep">Nombre del Departamento:</label>
                <input type="text" class="form-control mb-2" id="nombre_dep" name="nombre_dep" disabled
                    value="{{ $departamento->dep_nombre }}" />
            </div>
            <div class="form-group">
                <label for="mun_nombre">Nombre del Municipio:</label>
                <input type="text" class="form-control mb-2" id="mun_nombre" name="mun_nombre" required>
                @error('mun_nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-4 d-flex justify-content-between">
                <button class="btn btn-primary">Guardar</button>
                <a href="/gestiones/cat/municipios/listar/{{ $departamento->dep_id }}" class="btn btn-secondary">Regresar al
                    listado</a>
            </div>
        </form>

    </div>
@endsection
