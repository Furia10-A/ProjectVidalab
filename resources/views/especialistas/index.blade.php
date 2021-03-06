@extends('layouts.especial')
@extends('pop_up.modalEspecialistas')
@section('content')

    <head>
        @include('layouts.seccionesGenerales.cssDeTablas')
    </head>

    <body>
        @include('layouts.seccionesGenerales.css-jsDeModales')
        <div class="container-fluid">
            <div class="title">
				<h2 class="tituloDeRegistro"><span>R</span>egistro de <span>E</span>specialistas</h2>
			</div>
            <div class="card-body">
              <div class="col-md-8">
                  @if(session('imagen'))
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                  <script src="{{ asset('js/imagen.js') }}?v=<?php echo(rand()); ?>"defer></script>
                  @endif
              </div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <button type="button" class="btn btn-primary btnAgregar" data-toggle="modal" data-target="#agregarEspecialista" data-toggle="tooltip" data-placement="right" title="Click para agregar datos de nuevo especialista"><span class="icon-user"> </span>Registrar nuevo Especialista</button>
                    </div>
                </div>
                <br>

                <table id="registros" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col"><center>Identificador</center></th>
                            <th scope="col"><center>Nombre Completo</center></th>
                            <th scope="col"><center>Foto</center></th>
                            <th scope="col"><center>Correo Electrónico</center></th>
                            <th scope="col"><center>Sede<center></th>
                            <th scope="col"><center>Especialidades<center></th>
                            <th scope="col"><center>Acción a Realizar<center></th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col"><center>Identificador</center></th>
                            <th scope="col"><center>Nombre Completo</center></th>
                            <th scope="col"><center>Foto</center></th>
                            <th scope="col"><center>Correo Electrónico</center></th>
                            <th scope="col"><center>Sede<center></th>
                            <th scope="col"><center>Especialidades<center></th>
                            <th scope="col"><center>Acción a Realizar<center></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($especialistas as $especialista)
                        <tr>
                            <td><center>{{$especialista->id}}</center></td>
                            <td><center>{{$especialista->nombreDelEspecialista}} {{$especialista->segundoNombreDelEspecialista}} {{$especialista->primerApellidoDelEspecialista}} {{$especialista->segundoApellidoDelEspecialista}}</center></td>
                            @if($especialista->imagenDelEspecialista==null)
                                <td><center>  <img src="/perfilesDeEspecialistas/imagenFija.jpg" style="heigh: 160px; width:160px;"> </center></td>
                            @endif
                            @if($especialista->imagenDelEspecialista!=null)
                                <td><center>  <img src="/perfilesDeEspecialistas/{{$especialista->imagenDelEspecialista}}" style="heigh: 160px; width:160px;"> </center></td>
                            @endif
                            <td><center>{{$especialista->correoDelEspecialista}}</center></td>
                            <td><center>{{$especialista->sedeDelEspecialista}}</center></td>
                            <td><center>{{$especialista->especialidadesDelEspecialista}}</center></td>
                            <td><center>
                                <button type="button" class="btn btn-primary btnPerfil" data-toggle="modal" data-target="#agregarImagen" data-toggle="tooltip" data-placement="right" title="Click para actualizar foto de perfil del especialista"><span class="icon-camera"></span></button>
                                <a href="#" class="btn btn-info btnEditar" data-toggle="tooltip" data-placement="right" title="Click para actualizar los datos de esta especialista"><span class="icon-loop2"></span>
                                <a href="#" class="btn btn-danger btnEliminar" data-toggle="tooltip" data-placement="right" title="Click para eliminar todo el registro de esta especialista"><span class="icon-bin"></span></a>
                            </center></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <script src="{{ asset('js/transacciones/transaccionesDeEspecialistas.js') }}?v=<?php echo(rand()); ?>"defer></script>
            </div>
        </div>
        @include('layouts.seccionesGenerales.jsDeTablas')
    </body>
@endsection
