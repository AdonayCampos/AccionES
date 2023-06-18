@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Gestión de Departamentos y sus Municipios</h1>
        <a href="/gestiones/cat/departamentos/crear" class="btn btn-primary mb-3">Crear Departamento</a>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>N</th>
                        <th>Departamento</th>
                        <th>Estado</th>
                        <th class="col-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departamentos as $departamento)
                        <tr>
                            <td>{{ $departamento->dep_id }}</td>
                            <td>{{ $departamento->dep_nombre }}</td>
                            <td>
                                @if ($departamento->dep_estado == 1)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->usu_rol == 1)
                                    {{-- boton para modificar --}}
                                    <a class="btn btn-primary btn-sm"
                                        href="/gestiones/cat/departamentos/editar/{{ $departamento->dep_id }}">Modificar</a>
                                    {{-- boton para eliminar --}}
                                    <button class="btn btn-danger btn-sm"
                                        url="/gestiones/cat/departamentos/eliminar/{{ $departamento->dep_id }}"
                                        onclick="destroyDep(this)" token="{{ csrf_token() }}">Eliminar</button>
                                @elseif (Auth::user()->usu_rol == 2)
                                    {{-- boton para modificar --}}
                                    <a class="btn btn-primary btn-sm"
                                        href="/gestiones/cat/departamentos/editar/{{ $departamento->dep_id }}">Modificar</a>
                                @endif
                                <a class="btn btn-secondary btn-sm"
                                    href="/gestiones/cat/municipios/listar/{{ $departamento->dep_id }}">Ver Municipios</a>
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
