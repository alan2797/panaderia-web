<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class VentaFormRequest extends Request
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

            'tipo_comprobante'=>'required',
           'num_comprobante'=>'required',
           'fecha_hora',
           'impuesto',
           'estado',
           'total_venta'=>'required',
           'id_persona'=>'required',
           'id_distribucion'=>'required',
           'id_transporte'=>'required',
           //detalla venta
        'costo',
        'cantidad',
        'descuento',  
        'id_producto'=>'required',
        ];
    }
}
