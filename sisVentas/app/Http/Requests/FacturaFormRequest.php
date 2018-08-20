<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class FacturaFormRequest extends Request
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
            'codigo'=>'required|max:50',
            'cantidad'=>'required',
            'idproducto'=>'required',
            'unidad'=>'required',
            'precio_unitario'=>'required',
            'idarticulo'=>'required',


        ];
    }
}
