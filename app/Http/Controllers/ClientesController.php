<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use App\User;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  //PERMISOS
    public function __construct()
    {
      $this->middleware('auth:web')
      ->only
      (
        'verPerfil', 
        'IngresarCliente', 
        'subirImagen', 
        'editarPerfil'
      );

      $this->middleware('auth:admins')
      ->only
      (
        'listarClientes', 
        'perfilesDeClientes', 
        'graficarClientes'
      );
    }
  //


  //VER PERFIL: CLIENTE
    public function verPerfil()
    {
      $dato = auth()->user()->dniDelUsuario;
      $cliente = Clientes::find($dato);
      return view('Perfiles.perfil',compact('cliente'));
    }
  //


  //LISTAR: ADMINISTRADOR
    public function listarClientes()
    {
      $clientes = Clientes::orderBy('primerApellidoDelCliente', 'asc')->get();

      $name = auth()->administrador()->nombreDelUsuarioAdministrador;
      if (auth()->administrador()->estadoDelUsuarioAdministrador==1) {
      return view ('clientes.listaDeClientes',compact('name', 'clientes'));
      }
      else{
        return view('layouts.seccionesGenerales.accesoDenegado', compact('name'));
      }
    }
  //


  //VER PERFILES: ADMINISTRADOR
    public function perfilesDeClientes()
    {
      $perfiles = Clientes::orderBy('primerApellidoDelCliente', 'asc')->get();

      $perfilDisponible = 0;
      if(empty($perfiles))
      {
          $perfilDisponible = 0;
      }
      else{
          $perfilDisponible = '1';
      }

      $name = auth()->administrador()->nombreDelUsuarioAdministrador;
      if (auth()->administrador()->estadoDelUsuarioAdministrador==1) {
      return view ('clientes.perfilesDeClientes',compact('name', 'perfilDisponible','perfiles'));
      }
      else{
        return view('layouts.seccionesGenerales.accesoDenegado', compact('name'));
      }
    }
  //


  //REGISTRAR
    public function IngresarCliente()
    {
      $link = 0;
      return view('clientes.ingresarCliente', compact('link'));
    }
    public function CrearCliente(Request $request)
    {
      $data = $this->validate(request(),
      [
        'dniDelCliente' => 'required',
        'nombreDelCliente' => 'required',
        'primerApellidoDelCliente' => 'required',
        'segundoApellidoDelCliente' => 'required',
        'fechaDeNacimientoDelCliente' => 'required',
        'edadDelCliente' => 'required',
        'correoDelCliente' => 'required',
        'telefonoDelCliente' => 'required',
        'numeroDehijosDelcliente' => 'required',
        'domicilioDelCliente' => 'required',
        'aceptacionDeTerminos' => 'required'
      ]);
      $idUpdated = Auth()->user()->id;

      Auth()->user()->cliente()->create([
        'idUsuario' => $idUpdated,
        'dniDelCliente' => $data['dniDelCliente'],
        'nombreDelCliente' =>$data['nombreDelCliente'] ,
        'segundoNombreDelCliente' => request('segundoNombreDelCliente'),
        'primerApellidoDelCliente' =>$data['primerApellidoDelCliente'] ,
        'segundoApellidoDelCliente' => $data['segundoApellidoDelCliente'],
        'fechaDeNacimientoDelCliente' => $data['fechaDeNacimientoDelCliente'],
        'edadDelCliente' => $data['edadDelCliente'],
        'correoDelCliente' => $data['correoDelCliente'],
        'telefonoDelCliente' => $data['telefonoDelCliente'],
        'numeroDehijosDelcliente' =>$data['numeroDehijosDelcliente'] ,
        'domicilioDelCliente' => $data['domicilioDelCliente'],
        'aceptacionDeTerminos' => $data['aceptacionDeTerminos']
      ]);
      DB::table('users')
                ->where('id', auth()->user()->id)
                ->update(['name' => $data['nombreDelCliente']]);
      return redirect('/home');
      //actualizacion de tabla
      /*  DB::table('users')
              ->where('id', 7)
              ->update(['idCliente' => 9]);
      return redirect('/home');*/
    }
  //


  //AGREGAR PERFIL
    public function subirImagen()
    {
      $cliente = Clientes::find(auth()->user()->dniDelUsuario);
      if (request()->hasFile('imagenDelCliente')) {
        if ($cliente->imagenDelCliente!=null) {
          unlink(public_path().'/perfilesDeClientes/'.$cliente->imagenDelCliente);
        }
        $destinationPath = public_path().'/perfilesDeClientes';
        $files = request()->file('imagenDelCliente');
        $file_name = $files->getClientOriginalName(); //Get file original name
        $files->move($destinationPath , $file_name); // move files to destination folder
        $cliente->imagenDelCliente = $file_name;
        $cliente->update();
      }
      return redirect('/verPerfil');
    }
  //


  //EDITAR
    public function editarPerfil()
    {
      $cliente = Clientes::find(auth()->user()->dniDelUsuario);
      $cliente->update(request()->all());
      return redirect('/verPerfil');
    }
  //


  //GRAFICAR CLIENTES
    public function graficarClientes()
    {
      $clientes = Clientes::select(DB::raw("COUNT(*) as count"))
      ->whereYear('created_at',date('Y'))
      ->groupBy(DB::raw("Month(created_at)"))
      ->pluck('count');
    
      $meses = Clientes::select(DB::raw("Month(created_at) as month"))
      ->whereYear('created_at',date('Y'))
      ->groupBy(DB::raw("Month(created_at)"))
      ->pluck('month');

      $datos= array(0,0,0,0,0,0,0,0,0,0,0,0);
      foreach($meses as $index => $mes)
      {
        $datos[$mes] = $clientes[$index];
      }

      $name = auth()->administrador()->nombreDelUsuarioAdministrador;
      if (auth()->administrador()->estadoDelUsuarioAdministrador==1) {
      return view ('clientes.graficarClientes',compact('name', 'datos'));
      }
      else{
        return view('layouts.seccionesGenerales.accesoDenegado', compact('name'));
      }
    }

  //
}
