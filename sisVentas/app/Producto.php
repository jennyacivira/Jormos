<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table='producto';

    protected $primaryKey='idproducto';

    public $timestamps=false;


    protected $fillable =[
    	'idarticulo',
        'idcategoria',
    	'codigo',
    	'nombre',
    	'descripcion',
    	'partida_arancelaria',
        'sku'
    ];

    protected $guarded =[

    ];
}
