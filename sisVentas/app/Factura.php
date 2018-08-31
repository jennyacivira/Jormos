<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table='factura_comercial';

    protected $primaryKey='idfactura';

    public $timestamps=false;


    protected $fillable =[
    	'codigo',
    	'fecha',
    	'estado',
        'idarticulo',
        'descuento',
    ];

    protected $guarded =[

    ];
}
