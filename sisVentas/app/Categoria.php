<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';

    protected $primaryKey='idcategoria';

    public $timestamps=false;


    protected $fillable =[
    	'nombre',
        'codigo',
    	'descripcion',
    	'condicion',
        'direccion',
        'telefono',
        'email'
    ];

    protected $guarded =[

    ];

}