<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialista;
use App\User;
use App\Cliente;

class EspecialistaController extends Controller
{
    /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:web')->only('verEspecialistas');
    $this->middleware('auth:admins')->only('index', 'verPerfiles', 'guardar', 'actualizar', 'subirImagenEspecialista', 'eliminar');
  }

    //


    //LISTAR REGISTROS
        public function index ()
        {
            $especialistas = Especialista::all();
            $name = auth()->administrador()->nombreDelUsuarioAdministrador;
            if (auth()->administrador()->estadoDelUsuarioAdministrador==1) {
                return view('especialistas.index',compact('especialistas', 'acceso','name'));
            }
            else{
            return "<h1>Acceso Denegado </h1><h3>Lo sentimos $name <br> has sido inhabilitado!!!</h3>";
            }
        }
    //


    //ADMINISTRADORES: VER PERFILES
        public function verPerfiles()
        {
            $especialistas = Especialista::all();
            $id = Especialista::find('1');
            $datosDisponibles = 0;
            if(empty($id))
            {
                $datosDisponibles = 0;
            }
            else{
                $datosDisponibles = $id->id;
            }
            $name = auth()->administrador()->nombreDelUsuarioAdministrador;
            if (auth()->administrador()->estadoDelUsuarioAdministrador==1) {
                return view('especialistas.perfilDeEspecialistas',compact('especialistas', 'datosDisponibles', 'acceso','name'));
            }
            else{
            return "<h1>Acceso Denegado </h1><h3>Lo sentimos $name <br> has sido inhabilitado!!!</h3>";
            }
        }
    //


    //VER PERFILES, CLIENTES
        public function verEspecialistas()
        {
            $especialistas = Especialista::all();
            $id = Especialista::find('1');
            $datosDisponibles = 0;
            if(empty($id))
            {
                $datosDisponibles = 0;
            }
            else{
                $datosDisponibles = $id->id;
            }
            return view('especialistas.verEspecialistas', compact('especialistas', 'datosDisponibles'));
        }
    //








    //GUARDAR REGISTROS
        public function guardar (Request $request)
        {
            $especialista = new Especialista;

            $especialista->nombreDelEspecialista = $request->input('nombreDelEspecialista1');
            $especialista->segundoNombreDelEspecialista = $request->input('segundoNombreDelEspecialista1');
            $especialista->primerApellidoDelEspecialista = $request->input('primerApellidoDelEspecialista1');
            $especialista->segundoApellidoDelEspecialista = $request->input('segundoApellidoDelEspecialista1');
            $especialista->correoDelEspecialista = $request->input('correoDelEspecialista1');
            $especialista->sedeDelEspecialista = $request->input('sedeDelEspecialista1');
            $especialista->especialidadesDelEspecialista = $request->input('especialidadesDelEspecialista1');
            $especialista->save();
        }
    //


    //ACTUALIZAR REGISTROS
        public function actualizar (Request $request, $id)
        {
            $especialista = Especialista::find($id);

            $especialista->correoDelEspecialista = $request->input('correoDelEspecialista3');
            $especialista->sedeDelEspecialista = $request->input('sedeDelEspecialista3');
            $especialista->especialidadesDelEspecialista = $request->input('especialidadesDelEspecialista3');
            $especialista->save();
        }
    //


    //SUBIR FOTO DE PERFIL
        public function subirImagenEspecialista(Request $request)
        {
            $identificador = '';
            $identificador = $request->input('id');
            $especialista = Especialista::find($identificador);

            if (request()->hasFile('imagenDelEspecialista')) 
            {
                $destinationPath = public_path().'/perfilesDeEspecialistas';
                $files = request()->file('imagenDelEspecialista');
                $file_name = $files->getClientOriginalName();
                $files->move($destinationPath , $file_name);
                $especialista->imagenDelEspecialista = $file_name;
                $especialista->update();
            }
            return redirect('/especialistas');
        }
    //


    //ELIMINAR REGISTROS
        public function eliminar ($id)
        {
            $especialista = Especialista::find($id);
            $especialista->delete();
            return $especialista;
        }
    //


}