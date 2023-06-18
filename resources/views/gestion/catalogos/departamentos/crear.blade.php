@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Crear Departamento</h1>

        <form action="/gestiones/cat/departamentos/create" method="POST" class="mx-auto" style="max-width: 800px;">
            @csrf
            <div class="form-group">
                <label for="dep_nombre">Nombre del Departamento:</label>
                <input type="text" class="form-control mb-2" id="dep_nombre" name="dep_nombre" required>
                @error('dep_nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-4 d-flex justify-content-between">
                <button class="btn btn-primary">Guardar</button>
                <a href="/gestiones/cat/departamentos" class="btn btn-secondary">Regresar al listado</a>
            </div>
        </form>

    </div>
@endsection
