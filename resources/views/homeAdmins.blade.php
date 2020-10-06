@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('PROYECTO') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <h1>Lo has logrado superman ♥ </h1>
                    <a href="nuevoAdministrador">Agregar un nuevo Administrador </a>
                    <br>
                    <a href="/nuevaNotificacion">Enviar una nueva notificación </a>
                    <br>
                    <a href="/empresas">Registro empresas </a>
                    <br>
                    <a href="/citas">Registro completo de citas </a>
                    <br>
                    <a href="/pruebas">Registro de análisis </a>
                    <br>
                    <a href="/paquetes">Registro de paqutes de análisis </a>
                    <br>
                    <a href="/catalogos">Catálogos </a>
                    <br>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
