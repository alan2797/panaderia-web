<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
    protected $table='detalleventa';

    protected $primaryKey='id_detalle';

    public $timestamps=false;


    protected $fillable =[
    	'cantidad',
    	'costo',
        'descuento',
    	'id_venta',
    	'id_producto'
    ];

    protected $guarded =[

    ];
}
