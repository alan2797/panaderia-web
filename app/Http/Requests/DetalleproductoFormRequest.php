<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class DetalleproductoFormRequest extends Request
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
           //atributos produccion
          'fecha_produccion',
           'cantidad',
           'id_persona',
           'id_producto',
        
          //detalleproducto
        'id_insumo',
        'cantidadkg',
        ];
    }
}
