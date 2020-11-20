@extends('layouts.especial')
@extends('pop_up.modalAdministradores')
@section('content')

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"><script src="https://code.jquery.com/jquery-3.1.1.slim.min.js">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="js/transacciones/administradores.js"></script>
        <script src="js/buscador/buscadorDeRegistros.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="card-header"><h4><b><center>REGISTRO DE ADMINISTRADORES</center></b></h4></div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarAdministrador">Registrar nuevo Administrador</button></p>
                        </div>
                    </div>

                    <ul class="list-group">
                        <table id="registros"  class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><center>ID</center></th>
                                    <th scope="col"><center>Nombre</center></th>
                                    <th scope="col"><center>Cédula</center></th>
                                    <th scope="col"><center>teléfono</center></th>
                                    <th scope="col"><center>Correo</center></th>
                                    <th scope="col"><center>Rol</center></th>
                                    <th scope="col"><center>Estado</center></th>
                                    <th scope="col"><center>Acción a Realizar<center></th>
                                </tr>
                            </thead>

                            <tfoot class="thead-dark">
                                </tr>
                                    <th scope="col"><center>ID</center></th>
                                    <th scope="col"><center>Nombre</center></th>
                                    <th scope="col"><center>Cédula</center></th>
                                    <th scope="col"><center>teléfono</center></th>
                                    <th scope="col"><center>Correo</center></th>
                                    <th scope="col"><center>Rol</center></th>
                                    <th scope="col"><center>Estado</center></th>
                                    <th scope="col"><center>Acción a Realizar<center></th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <tr>
                                    <td><center>{{$superAdministradores->id}}</center></td>
                                    <td><center>{{$superAdministradores->primerApellidoAdministrador}} {{$superAdministradores->segundoApellidoAdministrador}} {{$superAdministradores->nombreDelUsuarioAdministrador}}</center></td>
                                    <td><center>{{$superAdministradores->dniDelUsuarioAdministrador}}</center></td>
                                    <td><center>{{$superAdministradores->telefonoDelUsuarioAdministrador}}</center></td>
                                    <td><center>{{$superAdministradores->email}}</center></td>
                                    <td><center>
                                        @if($superAdministradores->rol == 1)
                                            Super Administrador
                                        @else
                                            Administrador
                                        @endif
                                    </center></td>
                                    <td><center>Activo</center></td>
                                    <td><center>
                                        <a href="#" class="btn btn-info btnEditar">Actualizar</a>
                                    </center></td>
                                </tr>

                                @foreach($administradores as $administrador)
                                <tr>
                                    <td><center>{{$administrador->id}}</center></td>
                                    <td><center>{{$administrador->primerApellidoAdministrador}} {{$administrador->segundoApellidoAdministrador}} {{$administrador->nombreDelUsuarioAdministrador}}</center></td>
                                    <td><center>{{$administrador->dniDelUsuarioAdministrador}}</center></td>
                                    <td><center>{{$administrador->telefonoDelUsuarioAdministrador}}</center></td>
                                    <td><center>{{$administrador->email}}</center></td>
                                    <td><center>
                                        @if($administrador->rol == 1)
                                            Super Administrador
                                        @else
                                            Administrador
                                        @endif
                                    </center></td>
                                    <td><center>
                                        @if($administrador->estadoDelUsuarioAdministrador == 1)
                                            Activo
                                        @else
                                            Inactivo
                                        @endif
                                    </center></td>
                                    <td><center>
                                        <a href="#" class="btn btn-info btnEditar">Actualizar</a> <br></br>
                                        @if($administrador->estadoDelUsuarioAdministrador == 1)
                                            <a href="#" class="btn btn-danger btnInactivar">Denegar Acceso</a>
                                        @else
                                            <a href="#" class="btn btn-success btnActivar">Conceder Acceso</a>
                                        @endif
                                    </center></td>
                                </tr>
                                @endforeach   
                            </tbody>
                        </table>
                    </ul>
                </div>
            </div>
            <br>
            <center><a href="/administradores/activos" class="btn btn-dark">Administradores Activos</a>    |   <a href="/administradores/inactivos" class="btn btn-dark">Administradores Inactivos</a>    |   <a href="/homeAdmins" class="btn btn-dark">Ir al menú principal</a></center></center>
        </div>
    </body>  
@endsection

