@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Asignar responsable</h1>

        <form action="/gestiones/responsable/create" method="POST" class="mx-auto" style="max-width: 800px;">
            @csrf
            <div class="form-group">
                <input type="hidden" id="reg_id_ges" name="reg_id_ges" value="{{ $gestion->ges_id }}" />
                <label for="nombre">Nombre del Proyecto:</label>
                <input type="text" class="form-control mb-2" id="nombre" name="nombre" disabled
                    value="{{ $gestion->ges_nombre }}">
            </div>
            <div class="form-group">
                <label for="reg_id_per">Nombre del Responsable:</label>
                <select class="form-control mb-2" id="reg_id_per" name="reg_id_per" required>
                    <option value="">Seleccione un Responsable...</option>
                    @foreach ($empleados as $emp)
                        <option value="{{ $emp->per_id }}">
                            {{ $emp->primer_nombre . ' ' . $emp->segundo_nombre . ' ' . $emp->primer_apellido . ' ' . $emp->segundo_apellido . ' ' . $emp->apellido_casado }}
                        </option>
                    @endforeach
                </select>
                @error('reg_id_per')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="reg_cargo">Cargo que desempeñara:</label>
                <select class="form-control mb-2" id="reg_cargo" name="reg_cargo" required>
                    <option value="">Seleccione un cargo...</option>
                    <option value="1">Administrador/a</option>
                    <option value="2">Responsable</option>
                </select>
                @error('reg_cargo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-4 d-flex justify-content-between">
                <button class="btn btn-primary">Guardar</button>
                <a href="/gestiones/{{ $gestion->ges_id }}/responsable/listar/" class="btn btn-secondary">Regresar al
                    listado</a>
            </div>
        </form>

    </div>
@endsection
