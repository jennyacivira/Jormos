<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='venta';

    protected $primaryKey='idventa';

    public $timestamps=false;


    protected $fillable =[
    	'idfactura',
    	'idarticulo',
    	'fecha',
    	'total',
    	'orden_jormos'
    	
    ];

    protected $guarded =[

    ];
}
