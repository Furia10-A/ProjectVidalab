<link href="{{ asset('css/estiloDePopUp.css') }}?v=<?php echo(rand()); ?>" rel="stylesheet">
<!--TAMAÑOS
modal-dialog modal-xl
modal-dialog modal-lg
modal-dialog modal-sm<link rel="stylesheet" type="text/css" href="css/modal.css">

SCROLL
modal-dialog modal-dialog-scrollable
-->



<!--MODALS-->
    <!-- MODAL AGREGAR-->
        <div class="modal fade" id="agregarCita" tabindex="-1" aria-labelledby="labelAgregarCita" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-11 text-center col-11 text-center" id="labelAgregarCita">Nuevo Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="agregarForm">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-row">

                                <input type="text" name="id" id="idAgregar"><br>
                                
                                <div class="alert alert-info" role="alert">
                                    <center><b>¡Por favor, antes de Registrar verifique que los datos sean los correctos y respetar los formatos solicitados por el sistema!</b></center>
                                </div>

                                <label for="nombre1">Solicitante de cita: nombre</label>
                                <input type="text" class="form-control" placeholder="Escriba el nombre del solicitante de la cita" name="nombreDelSolicitante1" value="{{old('nombreDelSolicitante1')}}" /> <br>
                                @error('nombreDelSolicitante1')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <br></br>

                                <label for="primerApellido1">Primer apellido</label>
                                <input type="text" class="form-control" placeholder="Escriba el primer apellido del solicitante" name="primerApellidoDelSolicitante1" value="{{old('primerApellidoDelSolicitante1')}}"/> <br>
                                @error('primerApellidoDelSolicitante1')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <br></br>

                                <label for="segundoApellido1">Segundo apellido</label>
                                <input type="text" class="form-control" placeholder="Escriba el segundo apellido del solicitante" name="segundoApellidoDelSolicitante1" value="{{old('segundoApellidoDelSolicitante1')}}"/> <br>
                                @error('segundoApellidoDelSolicitante1')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <br></br>

                                <label for="clientes1">Número de clientes por atender</label>
                                <input type="text" class="form-control" placeholder="Escriba el total de cliente que serán atendidos" name="numeroDeClientesPorAtender1" value="{{old('numeroDeClientesPorAtender1')}}"/> <br>
                                @error('numeroDeClientesPorAtender1')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <br></br>

                                <label for="fecha1">Fecha de cita</label>
                                <input type="date" class="form-control" placeholder="Seleccione la fecha de cita" name="fechaDeCita" value="{{old('fechaDeCita1')}}"/> <br>
                                @error('fechaDeCita1')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <br></br>

                                <label for="hora1">Seleccione la hora de cita</label>
                                <input type="TIME" class="form-control" placeholder="Seleccione la hora de cita" name="horaDeCita" value="{{old('horaDeCita1')}}"/> <br>
                                @error('horaDeCita1')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <br></br>

                                <label for="analisis1">Escriba los tipos de análisis requeridos</label>
                                <textarea name="tiposDeAnalisisRequeridos1" class="form-control" cols="30" rows="5" placeholder="Escriba los tipos de análisis requeridos">{{old('tiposDeAnalisisRequeridos1')}}</textarea> <br>
                                @error('tiposDeAnalisisRequeridos1')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <br></br>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Registrar Empresa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--FIN MODAL AGREGAR -->


    <!-- MODAL EDITAR-->
        <div class="modal fade" id="editarCita" tabindex="-1" aria-labelledby="labelEditarCita" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-11 text-center" id="labelEditarCita">Editar Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editarForm">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="form-row">
                                <input type="hidden" name="id" id="idEditar">
                                
                                <div class="alert alert-warning" role="alert">
                                    <center><b>¡Por favor, verifique que el regitro a actualizar sea el correcto!</b></center>
                                </div>

                                <label for="nombre3">Solicitante de cita: nombre</label>
                                <input type="text" class="form-control" name="nombreDelSolicitante3" id="nombreDelSolicitante3" readonly/> <br>
                                <br></br>

                                <label for="clientes3">Número de clientes por atender</label>
                                <input type="text" class="form-control" placeholder="Escriba el total de cliente que serán atendidos" name="numeroDeClientesPorAtender3" id="numeroDeClientesPorAtender3"/> <br>
                                <br></br>

                                <label for="fecha3">Fecha de cita</label>
                                <input type="date" class="form-control" placeholder="Seleccione la fecha de cita" name="fechaDeCita3" id="fechaDeCita3"/> <br>
                                <br></br>

                                <label for="hora3">Seleccione la hora de cita</label>
                                <input type="TIME" class="form-control" placeholder="Seleccione la hora de cita" name="horaDeCita3" id="horaDeCita3"/> <br>
                                <br></br>

                                <label for="analisis3">Escriba los tipos de análisis requeridos</label>
                                <input type="text" class="form-control" placeholder="Escriba los tipos de análisis requeridos" name="tiposDeAnalisisRequeridos3" id="tiposDeAnalisisRequeridos3"/> <br>
                                <br></br>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Actualizar registro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--FIN MODAL EDITAR-->


    <!-- MODAL ELIMINAR-->
        <div class="modal fade" id="eliminarCita" tabindex="-1" aria-labelledby="labelEliminarCita" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-11 text-center" id="labelEliminarCita">Eliminar Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="eliminarForm">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <div class="form-row">
                                <input type="hidden" name="id" id="idEliminar">
                                
                                <div class="alert alert-danger" role="alert">
                                    <center>¡Lea cuidadosamente la información! <b>¿Realmente desea eliminar este registro?</b></center>
                                </div>

                                <label for="fecha4"><b>Fecha de cita</b></label>
                                <input type="text" class="form-control" name="fechaDeCita4" readonly="fechaDeCita4" id="fechaDeCita4"/>
                                <br> </br>
                                <label for="hora4"><b>Hora de cita</b></label>
                                <input type="text" class="form-control" name="horaDeCita4" readonly="horaDeCita4" id="horaDeCita4"/>
                            </div>

                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-secondary">Eliminar registro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--FIN MODAL ELIMINAR-->
