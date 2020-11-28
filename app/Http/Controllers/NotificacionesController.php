<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrador;
use App\Clientes;
use App\Empresa;
use App\Notificaciones;
use Illuminate\Support\Facades\Mail;
use App\Mail\envioDeNotificaciones;

class NotificacionesController extends Controller
{


  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('auth:admins');
    }
 //

  //MOSTRAR TODAS LAS NOTIFICACIONES
   public function Notificaciones()
    {
      $notificaciones = Notificaciones::orderBy('created_at', 'desc')->get();
      $name = auth()->administrador()->nombreDelUsuarioAdministrador;
      $nombre = [];
      $apellido = [];
      $contador=0;
      foreach ($notificaciones as $notificacion) {
        $administrador = Administrador::find($notificacion->idUsuarioAdministrador);
        $nombre[$contador] = $administrador->nombreDelUsuarioAdministrador;
        $apellido[$contador] = $administrador->primerApellidoAdministrador;
        $contador++;
      }
      return view('Notificaciones.todasLasNotificaciones',compact('name', 'notificaciones','nombre','apellido'));
    }
  //


  //MOSTRAR NOTIFICACIÓN ESPECÍFICA PARA CLIENTES
   public function NotificacionEspecifica()
    {
      $clientes = Clientes::all();
      $notificaciones = Notificaciones::orderBy('created_at', 'desc')->where('tipoDeNotificacion', '=', '1')->get();
      $name = auth()->administrador()->nombreDelUsuarioAdministrador;
      $nombre = [];
      $contador=0;
      foreach ($notificaciones as $notificacion) {
        $administrador = Administrador::find($notificacion->idUsuarioAdministrador);
        $nombre[$contador] = $administrador->nombreDelUsuarioAdministrador;
        $apellido[$contador] = $administrador->primerApellidoAdministrador;
        $contador++;
      }
      return view('Notificaciones.NotificacionEspecifica',compact('name','clientes', 'notificaciones','nombre','apellido'));
    }
  //


  //MOSTRAR NOTIFICACIÓN MASIVA PARA CLIENTES
   public function NotificacionMasiva()
   {
     $notificaciones = Notificaciones::orderBy('created_at', 'desc')->where('tipoDeNotificacion', '=', '2')->get();
     $name = auth()->administrador()->nombreDelUsuarioAdministrador;
     $nombre = [];
     $contador=0;
     foreach ($notificaciones as $notificacion) {
       $administrador = Administrador::find($notificacion->idUsuarioAdministrador);
       $nombre[$contador] = $administrador->nombreDelUsuarioAdministrador;
       $apellido[$contador] = $administrador->primerApellidoAdministrador;
       $contador++;
     }
     return view('Notificaciones.NotificacionMasiva',compact('name', 'notificaciones','nombre','apellido'));
   }
 //


  //MOSTRAR NOTIFICACIÓN ESPECÍFICA PARA EMPRESAS
    public function NotificacionEspecificaEmpresarial()
    {
      $empresas = Empresa::all();
      $notificaciones = Notificaciones::orderBy('created_at', 'desc')->where('tipoDeNotificacion', '=', '3')->get();
      $name = auth()->administrador()->nombreDelUsuarioAdministrador;
      $nombre = [];
      $contador=0;
      foreach ($notificaciones as $notificacion) {
        $administrador = Administrador::find($notificacion->idUsuarioAdministrador);
        $nombre[$contador] = $administrador->nombreDelUsuarioAdministrador;
        $apellido[$contador] = $administrador->primerApellidoAdministrador;
        $contador++;
      }
      return view('Notificaciones.NotificacionEspecificaEmpresarial',compact('name','empresas', 'notificaciones','nombre','apellido'));
    }
  //


  //MOSTRAR NOTIFICACIÓN MASIVA PARA EMPRESAS
    public function NotificacionMasivaEmpresarial()
    {
      $nombre = [];
      $contador=0;
      foreach ($notificaciones as $notificacion) {
        $administrador = Administrador::find($notificacion->idUsuarioAdministrador);
        $nombre[$contador] = $administrador->nombreDelUsuarioAdministrador;
        $apellido[$contador] = $administrador->primerApellidoAdministrador;
        $contador++;
      }
      $notificaciones = Notificaciones::orderBy('created_at', 'desc')->where('tipoDeNotificacion', '=', '4')->get();
      $name = auth()->administrador()->nombreDelUsuarioAdministrador;
      return view('Notificaciones.NotificacionMasivaEmpresarial',compact('name', 'notificaciones','nombre','apellido'));
    }
  //


  //AGREGAR Y ENVIAR NOTIFICACIÓN ESPECÍFICA PARA CLIENTES
    public function envioDeNotificacionEspecifica()
    {
      $data = $this->validate(request(),
      [
        'asunto'=>'required',
        'mensaje'=>'required',
        'clienteOpcion'=>'required',
        'tipoDeNotificacion'=>'required',
        'file'=>'nullable'
      ]);

      $id = auth()->administrador()->id;
      $mensaje = $data['mensaje'];
      Mail::to($data['clienteOpcion'])->send(new envioDeNotificaciones($data));
      $file_name = 'sin archivo';
      if (request()->hasFile('file')) {
        $destinationPath = public_path().'/archivos';
        $files = request()->file('file');
        $file_name = $files->getClientOriginalName(); //Get file original name
            $files->move($destinationPath , $file_name);
          }
      Notificaciones::create([
        'idUsuarioAdministrador' =>$id,
        'receptorDeNotificacion'  => $data['clienteOpcion'],
        'asuntoDeNotificacion' => $data['asunto'],
        'mensajeDeNotificacion' => $data['mensaje'],
        'tipoDeNotificacion'=>$data['tipoDeNotificacion'],
        'archivo' => $file_name,
      ]);

      return redirect('/notificaciones');
    }
  //


  //AGREGAR Y ENVIAR NOTIFICACIÓN MASIVA PARA CLIENTES
    public function envioDeNotificacionMasiva()
    {
      $data = $this->validate(request(),[
        'asunto'=>'required',
        'mensaje'=>'required',
        'tipoDeNotificacion'=>'required',
        'file'=>'nullable'
      ]);

      $todosLosClientes = Clientes::all();
      foreach ($todosLosClientes as $cliente)
      {
        Mail::to($cliente->correoDelCliente)->send(new envioDeNotificaciones($data));
      }

      $id = auth()->administrador()->id;
      $mensaje = $data['mensaje'];
      $file_name = 'sin archivo';
      if (request()->hasFile('file')) {
        $destinationPath = public_path().'/archivos';
        $files = request()->file('file');
        $file_name = $files->getClientOriginalName(); //Get file original name
            $files->move($destinationPath , $file_name);
          }
      Notificaciones::create([
        'idUsuarioAdministrador' =>$id,
        'receptorDeNotificacion'  => 'Todos los clientes',
        'asuntoDeNotificacion' => $data['asunto'],
        'mensajeDeNotificacion' => $data['mensaje'],
        'tipoDeNotificacion'=>$data['tipoDeNotificacion'],
        'archivo' => $file_name,
      ]);

      return redirect('/notificaciones');
    }
  //


  //AGREGAR Y ENVIAR NOTIFICACIÓN ESPECIFICA PARA EMPRESAS
    public function envioDeNotificacionEspecificaEmpresarial()
    {
      $data = $this->validate(request(),
      [
        'asunto'=>'required',
        'mensaje'=>'required',
        'clienteOpcion'=>'required',
        'tipoDeNotificacion'=>'required',
        'file'=>'nullable'
      ]);

      $id = auth()->administrador()->id;
      $mensaje = $data['mensaje'];
      Mail::to($data['clienteOpcion'])->send(new envioDeNotificaciones($data));
      $file_name = 'sin archivo';
      if (request()->hasFile('file')) {
        $destinationPath = public_path().'/archivos';
        $files = request()->file('file');
        $file_name = $files->getClientOriginalName(); //Get file original name
            $files->move($destinationPath , $file_name);
          }
      Notificaciones::create([
        'idUsuarioAdministrador' =>$id,
        'receptorDeNotificacion'  => $data['clienteOpcion'],
        'asuntoDeNotificacion' => $data['asunto'],
        'mensajeDeNotificacion' => $data['mensaje'],
        'tipoDeNotificacion'=>$data['tipoDeNotificacion'],
        'archivo' => $file_name,
      ]);

      return redirect('/notificaciones');
    }
  //


  //AGREGAR Y ENVIAR NOTIFICACIÓN MASIVA PARA EMPRESAS
    public function envioDeNotificacionMasivaEmpresarial()
    {
      $data = $this->validate(request(),[
        'asunto'=>'required',
        'mensaje'=>'required',
        'tipoDeNotificacion'=>'required',
        'file'=>'nullable'
      ]);

      $todosLosClientes = Empresa::all();
      foreach ($todosLosClientes as $cliente)
      {
        Mail::to($cliente->correoElectronicoDeLaEmpresa)->send(new envioDeNotificaciones($data));
      }

      $id = auth()->administrador()->id;
      $mensaje = $data['mensaje'];
      $file_name = 'sin archivo';
      if (request()->hasFile('file')) {
        $destinationPath = public_path().'/archivos';
        $files = request()->file('file');
        $file_name = $files->getClientOriginalName(); //Get file original name
            $files->move($destinationPath , $file_name);
          }
      Notificaciones::create([
        'idUsuarioAdministrador' =>$id,
        'receptorDeNotificacion'  => 'Todas las empresas',
        'asuntoDeNotificacion' =>$data['asunto'],
        'mensajeDeNotificacion' =>$data['mensaje'],
        'tipoDeNotificacion'=>$data['tipoDeNotificacion'],
        'archivo' => $file_name,
      ]);

      return redirect('/notificaciones');
    }
  //
}
