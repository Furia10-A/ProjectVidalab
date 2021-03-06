@extends('layouts.especial')
@extends('pop_up.modalPruebas')
@section('content')

    <head>
        @include('layouts.seccionesGenerales.cssDeTablas')
    </head>


    <body>
        @include('layouts.seccionesGenerales.css-jsDeModales')   
        <div class="container-fluid">
            <div class="title">
				<h2 class="tituloDeRegistro"><span>R</span>egistro de <span>A</span>nálisis</h2>
			</div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <button type="button" class="btn btn-primary btnAgregar" data-toggle="modal" data-target="#agregarPrueba" data-toggle="tooltip" data-placement="right" title="Click para agregar datos de nuevo análisis"><span class="icon-lab"> </span>Registrar nuevo Análisis</button>
                        <button type="button" class="btn btn-primary btnImportar" data-toggle="modal" data-target="#importarRegistros" data-toggle="tooltip" data-placement="right" title="Click para importar todos los registros"><span class="icon-lab"> </span><span class="icon-table2"> </span>Importar Registros</button>
                    </div>
                </div>

                <table id="registros" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col"><center>Código</center></th>
                            <th scope="col"><center>Nombre</center></th>
                            <th scope="col"><center>Categoría</center></th>
                            <th scope="col"><center>Descripción</center></th>
                            <th scope="col"><center>Costo</center></th>
                            <th scope="col"><center>Descuento</center></th>
                            <th scope="col"><center>Acción a Realizar</center></th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col"><center>Código</center></th>
                            <th scope="col"><center>Nombre</center></th>
                            <th scope="col"><center>Categoría</center></th>
                            <th scope="col"><center>Descripción</center></th>
                            <th scope="col"><center>Costo</center></th>
                            <th scope="col"><center>Descuento</center></th>
                            <th scope="col"><center>Acción a Realizar</center></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($pruebas as $prueba)
                        <tr>
                        <td><center>{{$prueba->codigoDelAnalisis}}</center></td>
                        <td><center>{{$prueba->nombreDelAnalisis}}</center></td>
                        <td><center>{{$prueba->categoriaDelAnalisis}}</center></td>
                        <td><center>{{$prueba->descripcionDelAnalisis}}</center></td>
                        <td><center>{{$prueba->costoDelAnalisis}}</center></td>
                        <td><center>{{$prueba->descuentoDelAnalisis}}</center></td>
                            <td><center>
                                <a href="#" class="btn btn-info btnEditar" data-toggle="tooltip" data-placement="right" title="Click para actualizar los datos de este análisis"><span class="icon-loop2"></span></a> <br></br>
                                <a href="#" class="btn btn-danger btnEliminar" data-toggle="tooltip" data-placement="right" title="Click para eliminar todo el registro de esta prueba"><span class="icon-bin"></span></a> <br></br>
                            </center></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <script src="{{ asset('js/transacciones/transaccionesDePruebas.js') }}?v=<?php echo(rand()); ?>"defer></script>
            </div>
        </div>
        @include('layouts.seccionesGenerales.jsDeTablas')
    </body>
@endsection

