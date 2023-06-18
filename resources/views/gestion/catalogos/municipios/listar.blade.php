@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Gestión de Municipios de {{ $dep->dep_nombre }}</h1>
        <div class="row">
            <div class="col-md-10">
                <a href="/gestiones/cat/municipios/crear/{{ $dep->dep_id }}" class="btn btn-primary mb-3">Crear Municipio</a>
            </div>
            <div class="col-md-2">
                <a href="/gestiones/cat/departamentos" class="btn btn-secondary mb-3">Regresar al listado</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>N</th>
                        <th>Municipio</th>
                        <th>Estado</th>
                        <th class="col-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($municipios as $municipio)
                        <tr>
                            <td>{{ $municipio->mun_id }}</td>
                            <td>{{ $municipio->mun_nombre }}</td>
                            <td>
                                @if ($municipio->mun_estado == 1)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td>
                                {{-- boton para modificar --}}
                                <a class="btn btn-primary btn-sm"
                                    href="/gestiones/cat/municipios/editar/{{ $municipio->mun_id }}">Modificar</a>

                                @if (Auth::user()->usu_rol == 1)
                                    {{-- boton para eliminar --}}
                                    <button class="btn btn-danger btn-sm"
                                        url="/gestiones/cat/municipios/eliminar/{{ $municipio->mun_id }}"
                                        onclick="destroyMun(this)" token="{{ csrf_token() }}">Eliminar</button>
                                @endif
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
    <script src="{{ asset('js/departamentos.js') }}"></script>
@endsection
