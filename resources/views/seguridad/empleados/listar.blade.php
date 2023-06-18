@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Gestión de Empleados</h1>
        <a href="/empleado/crear" class="btn btn-primary mb-3">Crear Empleado</a>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>N</th>
                    <th>Municipio Residencia</th>
                    <th>Nombre Completo</th>
                    <th>DUI</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Código Empleado</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->per_id }}</td>
                        <td>{{ $empleado->municipio }}</td>
                        <td>{{ $empleado->primer_nombre . ' ' . $empleado->segundo_nombre . ' ' . $empleado->primer_apellido . ' ' . $empleado->segundo_apellido . ' ' . $empleado->apellido_casado }}
                        </td>
                        <td>{{ $empleado->dui }}</td>
                        <td>{{ $empleado->fecha_nac->format('d/m/Y') }}</td>
                        <td>{{ $empleado->codigo }}</td>
                        <td>
                            @if ($empleado->usuario != null)
                                {{ $empleado->usuario }}
                            @else
                                Sin asignar
                            @endif

                        </td>
                        <td>
                            @if ($empleado->estado == 1)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </td>
                        <td>
                            {{-- boton para modificar --}}
                            <a class="btn btn-primary btn-sm" href="/empleado/editar/{{ $empleado->per_id }}">Modificar</a>

                            @if (Auth::user()->usu_rol == 1)
                                {{-- boton para eliminar --}}
                                <button class="btn btn-danger btn-sm" url="/empleado/eliminar/{{ $empleado->per_id }}"
                                    onclick="destroy(this)" token="{{ csrf_token() }}">Eliminar</button>
                            @endif
                            @if ($empleado->usuario != null)
                                <a class="btn btn-secondary btn-sm"
                                    href="/empleado/usuario/editar/{{ $empleado->usu_id }}">Modificar usuario</a>
                            @else
                                <a class="btn btn-secondary btn-sm"
                                    href="/empleado/usuario/crear/{{ $empleado->per_id }}">Crear usuario</a>
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
    <script src="{{ asset('js/empleado.js') }}"></script>
@endsection
