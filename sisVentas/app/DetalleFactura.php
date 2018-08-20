<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table='detalle_factura';

    protected $primaryKey='iddetalle_factura';

    public $timestamps=false;


    protected $fillable =[
    	'idfactura',
    	'idproducto',
    	'cantidad',
    	'precio_unitario',
    	'unidad'
    ];

    protected $guarded =[

    ];
}
