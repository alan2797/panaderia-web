<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    //
    protected $table='transporte';
    protected $primaryKey='id_transporte';

    public $timestamps= false;

    protected $fallable=[
          'placa',
          'modelo',
          'color',
          'descripcion'
          
   ];
     protected $guarded=[
     
   ];

}
