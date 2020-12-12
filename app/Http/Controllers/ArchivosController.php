<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Archivos;

class ArchivosController extends Controller
{
    
  //PERMISOS
    public function __construct()
    {
      $this->middleware('auth:admins')->only('multimedia','multimediaPost','verContenido','editarMultimedia');
      $this->middleware('auth:web')->only('galeriaDeFotos');
    }
  //


  //LISTA DE ARCHIVOS
    public function multimedia()
    {
      $archivos = Archivos::all();
      $name = auth()->administrador()->nombreDelUsuarioAdministrador;
      if (auth()->administrador()->estadoDelUsuarioAdministrador==1) {
          return view('archivos.index',compact('archivos','name'));
      }
      else{
      return "<h1>Acceso Denegado </h1><h3>Lo sentimos $name <br> has sido inhabilitado!!!</h3>";
      }
    }
  //


  //MOSTRAR FOTOS AL CLIENTE
    public function galeriaDeFotos()
    {

      $idFoto = Archivos::where('tipoDeArchivo', '==', 1)->get();
      $fotoDisponible = 0;
      if(empty($idFoto))
      {
          $fotoDisponible = '0';
      }
      else{
          $fotoDisponible = '1';
      }

      $fotos = Archivos::where('tipoDeArchivo', 1)->get();
      return view('archivos.galeriaDeFotos',compact('fotos','name', 'fotoDisponible'));
    }
  //


  //MOSTRAR VIDEOS AL CLIENTE
    public function galeriaDeVideos()
    {

      $idVideo = Archivos::where('tipoDeArchivo', '==', '2')->get();
      $videoDisponible = 0;
      if(empty($idVideo))
      {
          $videoDisponible = '0';
      }
      else{
          $videoDisponible = '1';
      }

      $videos = Archivos::where('tipoDeArchivo', 2)->get();
      return view('archivos.galeriaDeVideos',compact('videos','name', 'videoDisponible'));
    }
  //


  //VER GALERÍA: ADMINISTRADOR
    public function verContenido()
    {
      $archivos = Archivos::all();
      $name = auth()->administrador()->nombreDelUsuarioAdministrador;
      if (auth()->administrador()->estadoDelUsuarioAdministrador==1) {
          return view('archivos.multimedia',compact('archivos','name'));
      }
      else{
      return "<h1>Acceso Denegado </h1><h3>Lo sentimos $name <br> has sido inhabilitado!!!</h3>";
      }
    }
  //


  //REGISTRAR ARCHIVO
    public function multimediaPost()
    {
      $nombre = '';
      if (request()->hasFile('file')) 
      {
        $destinationPath = public_path().'/archivosMultimedia';
        $files = request()->file('file');
        $file_name = $files->getClientOriginalName(); //Get file original name
        $files->move($destinationPath , $file_name); // move files to destination folder
        $nombre = $file_name;
      }
      if (request()->hasFile('fileVideo')) 
      {
        $destinationPath = public_path().'/archivosMultimedia';
        $files = request()->file('fileVideo');
        $file_name = $files->getClientOriginalName(); //Get file original name
        $files->move($destinationPath , $file_name); // move files to destination folder
        $nombre = $file_name;
      }
      Archivos::create([
        'tipoDeArchivo'=> request('tipoDeArchivo'),
        'nombreDelArchivo'=>$nombre,
        'descripcionDelArchivo'=>request('descripcionDelArchivo')
      ]);
      return redirect('/multimedia')->with('status','agregado');
    }
  //



  //EDITAR REGISTRO
    public function editarMultimedia(Archivos $archivo)
    {
      $nombre = $archivo->nombreDelArchivo;
      $tipo = $archivo->tipoDeArchivo;
      if (request()->hasFile('file')) 
      {
        unlink(public_path().'/archivosMultimedia/'.$nombre);
        $destinationPath = public_path().'/archivosMultimedia';
        $files = request()->file('file');
        $file_name = $files->getClientOriginalName(); //Get file original name
        $files->move($destinationPath , $file_name); // move files to destination folder
        $nombre = $file_name;
        $tipo = request('tipoDeArchivo');
      }
      if (request()->hasFile('fileVideo')) {
        unlink(public_path().'/archivosMultimedia/'.$nombre);
        $destinationPath = public_path().'/archivosMultimedia';
        $files = request()->file('fileVideo');
        $file_name = $files->getClientOriginalName(); //Get file original name
        $files->move($destinationPath , $file_name); // move files to destination folder
        $nombre = $file_name;
        $tipo = request('tipoDeArchivo');
      }

      $archivo->tipoDeArchivo = $tipo;
      $archivo->nombreDelArchivo = $nombre;
      $archivo->descripcionDelArchivo = request('descripcionDelArchivo');
      $archivo->update();

      return redirect('/multimedia');
    }
  //
}
