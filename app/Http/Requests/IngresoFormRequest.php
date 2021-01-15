<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class IngresoFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           
          'tipo_comprobante',
           'numero_comprobante',
           'fecha_hora',
           'impuesto',
           'estado',
           'id_persona',

        'precio_compra',
        'cantidad',
        'id_insumo',
        //'id_ingreso'
        ];
    }
}
