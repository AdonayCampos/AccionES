@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Gestión de Usuarios</h1>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>N</th>
                    <th>Nombre Completo</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->usu_id }}</td>
                        <td>{{ $usuario->primer_nombre . ' ' . $usuario->segundo_nombre . ' ' . $usuario->primer_apellido . ' ' . $usuario->segundo_apellido }}
                        </td>
                        <td>{{ $usuario->usu_usuario }}</td>
                        <td>
                            @if ($usuario->usu_rol == 1)
                                Administrador
                            @elseif ($usuario->usu_rol == 2)
                                Responsable
                            @else
                                Ciudadano
                            @endif
                        </td>
                        <td>
                            @if ($usuario->usu_estado == 1)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </td>
                        <td>
                            @if (Auth::user()->usu_rol == 1)
                                {{-- boton para modificar --}}
                                <a class="btn btn-primary btn-sm" href="/usuario/editar/{{ $usuario->usu_id }}">Modificar</a>
                                {{-- boton para eliminar --}}
                                <button class="btn btn-danger btn-sm" url="/usuario/eliminar/{{ $usuario->usu_id }}"
                                    onclick="destroy(this)" token="{{ csrf_token() }}">Eliminar</button>
                            @elseif (Auth::user()->usu_rol == 2 and $usuario->usu_rol == 3)
                                {{-- boton para modificar --}}
                                <a class="btn btn-primary btn-sm"
                                    href="/usuario/editar/{{ $usuario->usu_id }}">Modificar</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    {{-- SweetAlert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- JS --}}
    <script src="{{ asset('js/usuario.js') }}"></script>
@endsection
