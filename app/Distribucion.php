<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribucion extends Model
{
    //
    protected $table='distribucion';
     protected $primaryKey='id_distribucion';

     public $timestamps= false;

     protected $fallable=[
           'tipo_envio',
           'descripcion'
           
     ];
      protected $guarded=[
      
    ];
}
