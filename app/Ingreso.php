<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //
    protected $table='ingreso';
     protected $primaryKey='id_ingreso';

     public $timestamps= false;

     protected $fallable=[
           'tipo_comprobante',
           'numero_comprobante',
            'fecha_hora',
           'impuesto',
           'estado',
           'id_persona'
           
     ];
      protected $guarded=[
      
    ];
}
