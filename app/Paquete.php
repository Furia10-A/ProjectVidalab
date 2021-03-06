<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
  
  //ESTABLECER LLAVE PRIMARIA DISTINTA AL ID POR DEFECTO
    protected $primaryKey = 'codigoDelPaquete';
    protected $keyType = 'string';


  //RELACIÓN



  //ATRIBUTOS DE INGRESO MANUAL
    protected $fillable =
    [
      'codigoDelPaquete',
      'nombreDelPaquete',
      'imagenDelPaquete',
      'descripcionDelPaquete',
      'costoDelPaquete'
    ];
  }
