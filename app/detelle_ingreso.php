<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detelle_ingreso extends Model
{
    //
    protected $table='detalle_ingreso';

    protected $primaryKey='id_detalle';

    public $timestamps=false;


    protected $fillable =[
    	'precio_compra',
        'cantidad',
    	'id_insumo',
    	'id_ingreso'
    ];

    protected $guarded =[

    ];
}
