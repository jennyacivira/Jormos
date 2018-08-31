<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ProductoFormRequest extends Request
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
            'codigo'=>'required|max:20',
            'nombre'=>'required|max:256',
            'descripcion'=>'max:700',
            'partida_arancelaria'=>'max:20',
            'idcategoria'=>'required',
            'sku'=>'max:20',
           
        ];
    }
}
