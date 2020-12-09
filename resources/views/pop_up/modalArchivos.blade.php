<link href="{{ asset('css/estiloDePopUp.css') }}?v=<?php echo(rand()); ?>" rel="stylesheet">
<script src="{{ asset('js/cambiarNombre.js') }}?v=<?php echo(rand()); ?>"defer></script>

<!--TAMAÑOS
modal-dialog modal-xl
modal-dialog modal-lg
modal-dialog modal-sm
SCROLL
modal-dialog modal-dialog-scrollable
-->
<!-- MODALS-->

    <!-- MODAL AGREGAR-->
        <div class="modal fade" id="agregarArchivo" tabindex="-1" aria-labelledby="labelAgregarEspecialista" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-ms">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title col-11 text-center col-11 text-center" id="labelAgregarEspecialista">ARCHIVO MULTIMEDIA</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="/multimediaPost" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                                <div class="row">
                                    <label for="" class="col-12 text-center">Tipo de Archivo</label>
                                  <select onchange="visible()" id="opcion" required  class="form-control" name="tipoDeArchivo">
                                      <option class="modal-title col-11 text-center col-11 text-center" value="0"></option>
                                      <option value="1">Imagen</option>
                                      <option value="2">Video</option>
                                    </select>
                                    @error('tipoDeArchivo')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror

                                    <label id="lblVideo" hidden for="" class="col-12 text-center">Video</label>
                                    <input id="txtVideo" hidden type="file" name="fileVideo" accept="video/*" value="">
                                    <label id="lblImagen" hidden for="" class="col-12 text-center">Imagen</label>
                                    <input id="txtImagen" hidden  type="file" name="file" accept="image/*" value="">
                                </div>
                                <div class="row">
                                    <label for="" class="col-12 text-center">Descripción</label>
                                    <textarea class="form-control" name="descripcionDelArchivo" required rows="4" cols="80"></textarea>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--FIN MODAL editarPerfil -->

    <!--FIN MODAL AGREGAR-->


    <!-- MODAL EDITAR-->
        <div class="modal fade" id="editarMultimedia" tabindex="-1" aria-labelledby="labelEditarEspecialista" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-11 text-center" id="labelEditarEspecialista">Editar Contenido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editarForm" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                      <div class="modal-body">
                          {{ csrf_field() }}
                          {{method_field('PUT')}}
                          <input type="text" hidden id="idEditar" name="" value="">
                              <div class="row">
                                  <label for="" class="col-12 text-center">Tipo de Archivo</label>
                                <select onchange="visible1()" id="opcion1" required  class="form-control" name="tipoDeArchivo">
                                    <option class="modal-title col-11 text-center col-11 text-center" value="0"></option>
                                    <option value="1">Imagen</option>
                                    <option value="2">Video</option>
                                  </select>
                                  @error('tipoDeArchivo')
                                      <div class="alert alert-danger">{{$message}}</div>
                                  @enderror

                                  <label id="lblVideo1" hidden for="" class="col-12 text-center">Video</label>
                                  <input id="txtVideo1" hidden type="file" name="fileVideo" accept="video/*" value="">
                                  <label id="lblImagen1" hidden for="" class="col-12 text-center">Imagen</label>
                                  <input id="txtImagen1" hidden  type="file" name="file" accept="image/*" value="">
                              </div>
                              <div class="row">
                                  <label for="" class="col-12 text-center">Descripción</label>
                                  <textarea class="form-control" id="descripcionDelArchivo" name="descripcionDelArchivo" required rows="4" cols="80"></textarea>

                              </div>

                      </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--FIN MODAL EDITAR-->


    <!-- MODAL ELIMINAR-->
        <div class="modal fade" id="eliminarEspecialista" tabindex="-1" aria-labelledby="labelEliminarEspecialista" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-11 text-center" id="labelEliminarEspecialista">Eliminar Registro Completo de la Empresa</h5>
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
                                    <center>¡Lea cuidadosamente la información!</center>
                                </div>

                                <label for="nombreCompletoDelEspecialista4" class="col-12 text-center">Nombre completo</label>
                                <input required type="text" class="form-control" name="nombreCompletoDelEspecialista4" id="nombreCompletoDelEspecialista4" readonly/> <br>

                                <br></br>

                                <label for="sedeDelEspecialista4" class="col-12 text-center">Sede</label>
                                <input required type="text" class="form-control" name="sedeDelEspecialista4" id="sedeDelEspecialista4" readonly/> <br>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-secondary btn-lg">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--FIN MODAL ELIMINAR-->
