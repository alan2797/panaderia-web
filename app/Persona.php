<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table='persona';
     protected $primaryKey='id_persona';

     public $timestamps= false;

     protected $fallable=[
           'nombre',
           'tipopersona',
           'tipodocumento',
           'numero_documento',
           'direccion',
           'telefono',
           'email',
           'estado'
     ];
      protected $guarded=[
      
    ];
}
