@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            width: 400px;
            padding: 40px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 3px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #007bff;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            max-width: 200px;
            max-height: 200px;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #0056b3;
        }
    </style>
    <div class="login-container">
        <div class="login-form">
            <div class="logo-container">
                <img src="/img/accionES.png" alt="AccionES" class="logo">
            </div>
            <h2>Iniciar sesión</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="usu_usuario">Usuario:</label>
                    <input id="usu_usuario" class="form-control @error('usu_usuario') is-invalid @enderror"
                        name="usu_usuario" value="{{ old('usu_usuario') }}" required autocomplete="usu_usuario" autofocus>

                    @error('usu_usuario')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="usu_pass">Contraseña:</label>
                    <input id="usu_pass" type="password" class="form-control @error('usu_pass') is-invalid @enderror"
                        name="usu_pass" required autocomplete="current-password">

                    @error('usu_pass')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </form>
            <div class="register-link">
                <a href="/registro_usuario">Registrar nuevo usuario</a>
            </div>
        </div>
    </div>
@endsection
