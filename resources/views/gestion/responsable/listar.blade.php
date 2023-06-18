@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Gestión de Responsables de {{ $gestion->ges_nombre }}</h1>
        <div class="row">
            <div class="col-md-10">
                <a href="/gestiones/{{ $gestion->ges_id }}/responsable/crear" class="btn btn-primary mb-3">Asignar
                    responsables</a>
            </div>
            <div class="col-md-2">
                <a href="/gestiones/listar" class="btn btn-secondary mb-3">Regresar al listado</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>N</th>
                        <th>Nombre del Responsable</th>
                        <th>Cargo</th>
                        <th class="col-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($responsables as $responsable)
                        <tr>
                            <td>{{ $responsable->reg_id }}</td>
                            <td>{{ $responsable->persona->per_primer_nombre . ' ' . $responsable->persona->per_segundo_nombre . ' ' . $responsable->persona->per_primer_apellido . ' ' . $responsable->persona->per_segundo_apellido . ' ' . $responsable->persona->per_apellido_casado }}
                            </td>
                            <td>
                                @if ($responsable->reg_cargo == 1)
                                    Administrador/a
                                @else
                                    Reponsable
                                @endif
                            </td>
                            <td>
                                {{-- boton para eliminar --}}
                                <button class="btn btn-danger btn-sm"
                                    url="/gestiones/{{ $responsable->reg_id }}/responsable/eliminar"
                                    onclick="destroyRes(this)" token="{{ csrf_token() }}">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- SweetAlert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- JS --}}
    <script src="{{ asset('js/gestion.js') }}"></script>
@endsection
