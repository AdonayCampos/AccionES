@extends('layouts.app')

@section('content')
    <style>
        .custom-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .custom-card:hover {
            background-color: #f0f0f0;
        }

        .custom-card i {
            color: #4285f4;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .panel-icon {
            width: 50px;
            /* Ajusta el tamaño de la imagen según tus necesidades */
            height: 50px;
            margin-bottom: 10px;
        }
    </style>
    <div class="container">
        @if (Auth::user()->usu_rol != 3)
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card custom-card" id="security-card">
                        <div class="card-body">
                            <img src="/img/seguridad.png" alt="Modulo de Seguridad" class="panel-icon">
                            <h5 class="card-title">Seguridad</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card custom-card" id="gestion-card">
                        <div class="card-body">
                            <img src="/img/proyectos.png" alt="Modulo de Gestion de proyectos" class="panel-icon">
                            <h5 class="card-title">Gestión de Proyectos</h5>
                        </div>
                    </div>
                </div>
        @endif
        <div class="col-md-4">
            <div class="card custom-card" id="reports-card">
                <div class="card-body">
                    <img src="/img/proyectos.png" alt="Modulo de Reportes" class="panel-icon">
                    <h5 class="card-title">Reportes</h5>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var securityCard = document.getElementById('security-card');
            securityCard.addEventListener('click', function() {
                window.location.href =
                    '/seguridad'; // Cambia '/security' por la ruta a tu página de seguridad
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var securityCard = document.getElementById('gestion-card');
            securityCard.addEventListener('click', function() {
                window.location.href =
                    '/gestiones'; // Cambia '/gestion' por la ruta a tu página de seguridad
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var securityCard = document.getElementById('reports-card');
            securityCard.addEventListener('click', function() {
                window.location.href =
                    '/reportes'; // Cambia '/gestion' por la ruta a tu página de seguridad
            });
        });
    </script>
@endsection
