
	@extends('layouts.app')
@section('content')


	<div class="container">

        <div class="card-header">
           <h3><b><center>Contenido Informativo</center></b></h3>
        </div>
        <link rel="stylesheet" type="text/css" href="css/estiloDelCatalogo.css?=<?php echo(rand()); ?>">
				<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		    <script src="{{ asset('js/localStorage.js') }}"defer></script>


        @foreach($archivos as $archivo)
            <div class="card">
              <?php if ($archivo->tipoDeArchivo=='1'): ?>
                <img id="imagenMultimedia" src="/imagenes/{{$archivo->nombreDelArchivo}}" alt="contenido multimedia" control>
              <?php endif; ?>
                <?php if ($archivo->tipoDeArchivo=='2'): ?>
                  <video width="320" height="240" controls>
                          <source src="imagenes/{{$archivo->nombreDelArchivo}}" type="video/mp4">
                          <source src="imagenes/{{$archivo->nombreDelArchivo}}" type="video/ogg">
                          Your browser does not support the video tag.
                        </video>
                <?php endif; ?>
                <br>
                <h5><p>{{$archivo->descripcionDelArchivo}}</p></h5>

            </div>
        @endforeach


@endsection
