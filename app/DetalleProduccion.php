<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleProduccion extends Model
{
    //
    protected $table='detalleproducto';
     protected $primaryKey='id_detalle';

     public $timestamps= false;

     protected $fallable=[
           'id_produccion',
           'id_insumo',
           'cantidadkg'  
     ];
      protected $guarded=[
      
    ];
}
