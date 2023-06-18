@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Gestión de cursos, eventos y proyectos</h1>
        <a href="/gestiones/crear" class="btn btn-primary mb-3">Crear una Gestión</a>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>N</th>
                        <th>Tipo de Gestión</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Fechas</th>
                        <th>Numero de Beneficiados</th>
                        <th>Ubicacion</th>
                        <th colspan="col-2">Estado</th>
                        <th class="col-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gestiones as $gestion)
                        <tr>
                            <td>{{ $gestion->ges_id }}</td>
                            <td>
                                @if ($gestion->ges_tipo_gestion == 1)
                                    Curso
                                @elseif($gestion->ges_tipo_gestion == 2)
                                    Evento
                                @else
                                    Proyecto
                                @endif
                            </td>
                            <td>{{ $gestion->ges_nombre }}</td>
                            <td>{{ $gestion->ges_descripcion }}</td>
                            <td>Fecha Inicio: <b>{{ $gestion->ges_fecha_inicio->format('d/m/Y') }}</b><br>Fecha
                                finalización:
                                <b>{{ $gestion->ges_fecha_fin->format('d/m/Y') }}</b>
                            </td>
                            <td>{{ $gestion->ges_num_benef }}</td>
                            <td>{{ $gestion->municipio->mun_nombre }}, {{ $gestion->municipio->departamento->dep_nombre }}
                            </td>
                            <td>
                                @if ($gestion->ges_estado == 1)
                                    Pendiente de aprobar
                                @elseif ($gestion->ges_estado == 2)
                                    Aprobado
                                @elseif ($gestion->ges_estado == 3)
                                    En ejecucion
                                @elseif ($gestion->ges_estado == 4)
                                    Finalizado
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->usu_rol == 1)
                                    {{-- boton para modificar --}}
                                    <a class="btn btn-primary btn-sm"
                                        href="/gestiones/editar/{{ $gestion->ges_id }}">Modificar</a>
                                    {{-- boton para eliminar --}}
                                    <button class="btn btn-danger btn-sm" url="/gestiones/eliminar/{{ $gestion->ges_id }}"
                                        onclick="destroyDep(this)" token="{{ csrf_token() }}">Eliminar</button>
                                @elseif (Auth::user()->usu_rol == 2)
                                    {{-- boton para modificar --}}
                                    <a class="btn btn-primary btn-sm"
                                        href="/gestiones/editar/{{ $gestion->ges_id }}">Modificar</a>
                                @endif
                                <a class="btn btn-secondary btn-sm"
                                    href="/gestiones/{{ $gestion->ges_id }}/responsable/listar/">Ver Responsable</a>
                                @if ($gestion->ges_estado == 1)
                                    <button class="btn btn-success btn-sm"
                                        url="/gestiones/listar/aprobar/{{ $gestion->ges_id }}" onclick="aprobarGes(this)"
                                        token="{{ csrf_token() }}">Aprobar</button>
                                @elseif ($gestion->ges_estado == 2 and Auth::user()->usu_rol == 1)
                                    <button class="btn
                                        btn-success btn-sm"
                                        url="/gestiones/listar/revertir/{{ $gestion->ges_id }}" onclick="revertirGes(this)"
                                        token="{{ csrf_token() }}">Revertir estado</button>
                                    <button class="btn
                                        btn-warning btn-sm"
                                        url="/gestiones/listar/ejecutar/{{ $gestion->ges_id }}" onclick="ejecutarGes(this)"
                                        token="{{ csrf_token() }}">Ejecutar</button>
                                @elseif ($gestion->ges_estado == 3 and Auth::user()->usu_rol == 1)
                                    <button class="btn
                                        btn-success btn-sm"
                                        url="/gestiones/listar/revertir/{{ $gestion->ges_id }}" onclick="revertirGes(this)"
                                        token="{{ csrf_token() }}">Revertir
                                        estado</button>
                                    <button class="btn
                                        btn-info btn-sm"
                                        url="/gestiones/listar/finalizar/{{ $gestion->ges_id }}"
                                        onclick="finalizarGes(this)" token="{{ csrf_token() }}">Finalizar</button>
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
    <script src="{{ asset('js/gestion.js') }}"></script>
@endsection
