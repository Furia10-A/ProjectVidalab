@extends('layouts.especial')
@section('content')

    <head>
        @include('layouts.seccionesGenerales.cssDeTablas')
    </head>

    <body>
        @include('layouts.seccionesGenerales.css-jsDeModales')   
            <div class="container-fluid">

            <div class="title">
				<h2 class="tituloDeRegistro"><span>R</span>egistro de <span>C</span>lientes <span>A</span>filiados</h2>
            </div>
            <div id="contenedor" class="shadow-lg p-3 mb-5 bg-white"></div>
            <div class="card-body" text-center>
                <table id="registros" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col"><center>Nombre</center></th>
                            <th scope="col"><center>Fecha de Nacimiento</center></th>
                            <th scope="col"><center>Edad Actual</center></th>
                            <th scope="col"><center>Hijos</center></th>
                            <th scope="col"><center>Correo Electrónico</center></th>
                            <th scope="col"><center>Teléfono</center></th>
                            <th scope="col"><center>Domicilio</center></th>
                            <th scope="col"><center>Cliente Desde</center></th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col"><center>Nombre</center></th>
                            <th scope="col"><center>Fecha de Nacimiento</center></th>
                            <th scope="col"><center>Edad Actual</center></th>
                            <th scope="col"><center>Hijos</center></th>
                            <th scope="col"><center>Correo Electrónico</center></th>
                            <th scope="col"><center>Teléfono</center></th>
                            <th scope="col"><center>Domicilio</center></th>
                            <th scope="col"><center>Cliente Desde</center></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($clientes as $cliente)
                        <tr>
                            <td><center>{{$cliente->nombreDelCliente}} {{$cliente->segundoNombreDelCliente}} {{$cliente->primerApellidoDelCliente}} {{$cliente->segundoApellidoDelCliente}}</center></td>
                            <td><center>{{$cliente->fechaDeNacimientoDelCliente}}</center></td>
                            <td><center><?php $date1 = new DateTime('now');$date2 = new DateTime("$cliente->fechaDeNacimientoDelCliente");$diff = $date1->diff($date2);echo $diff->y .' años '; ?></center></td>
                            <td><center>{{$cliente->numeroDehijosDelcliente}}</center></td>
                            <td><center>{{$cliente->correoDelCliente}}</center></td>
                            <td><center>{{$cliente->telefonoDelCliente}}</center></td>
                            <td><center>{{$cliente->domicilioDelCliente}}</center></td>
                            <td><center>{{ \Carbon\Carbon::parse( $cliente->created_at)->format('m/Y')}}</center></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <center><a href="/homeAdmins" class="btn btn-dark">Ir al menú principal</a></center>
        </div>
        @include('layouts.seccionesGenerales.jsDeTablaClientes')
        
    </body>
@endsection
   