<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table='venta';
     protected $primaryKey='id_venta';

     public $timestamps= false;

     protected $fallable=[
           'tipo_comprobante',
           'num_comprobante',
            'fecha_hora',
           'impuesto',
           'estado',
           'total_venta',
           'id_persona',
           'id_distribucion',
           'id_transporte'
           
     ];
      protected $guarded=[
      
    ];
}
