<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table='insumo';
    protected $primaryKey='id_insumo';

    public $timestamps= false;

    protected $fallable=[
          'id_insumo',
          'nombre',
          'descripcion',
          'stockkg',
          'estado',
          'imagen',
    ];
     protected $guarded=[
     
   ];
}
