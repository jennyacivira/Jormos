<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\IngresoFormRequest;
use sisVentas\Ingreso;
use sisVentas\DetalleIngreso;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection

class IngresoController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $ingresos=DB::table('ingreso as i')
            ->join('persona as p','i.idproveedor','=','p.idpersona')
            ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.ingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('i.num_comprobante','LIKE','%'.query.'%')
            ->orderBy('i.idingreso','desc')
            ->groupBy('i.ingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')	
            ->paginate(7);
            return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }
    public function create()
    {
    	$personas=DB::table('persona')->where('tipo_persona','=','Proveedor')->get();
    	$articulos =DB::table('articulo as art')
    	->select(DB::raw('CONCAT(art.codigo," ",art.nombre) AS articulo'),'art.idarticulo')
    	->where('art.estado','=','Activo')
    	->get();

        return view("compras.ingreso.create",["personas"=>$personas,"articulos"=>$articulos]);
    }

    public function store (IngresoFormRequest $request)
    {
    	try{
    		DB::beginTransaction();
    		$ingreso=new Ingreso;
	        $ingreso->idproveedor=$request->get('idproveedor');
	        $persona->tipo_comprobante=$request->get('tipo_comprobante');
	        $persona->serie_comprobante=$request->get('serie_comprobante');
	        $persona->num_comprobante=$request->get('num_comprobante');
	        $mytime = Carbon::('America/Lima');
	        $ingreso->fecha_hora=$mytime->toDateTimeString();
	        $ingreso->impuesto='18';
	        $ingreso->estado='A';
	        $ingreso->save();

	        $idarticulo = $request->get('idarticulo');
	        $cantidad = $request->get('cantidad');
	        $precio_compra = $request->get('precio_compra');
	        $precio_venta = $request->get('precio_venta');

	        $cont = 0;
	        while($cont < count($idarticulo)){
	        	$cont=$cont +1;
	        } 

    		DB::commit();

    	}catch(\Exception $e){

    		DB::rooback();
    	}
       
        return Redirect::to('compras/proveedor');

    }
    public function show($id)
    {
        return view("compras.proveedor.show",["persona"=>Persona::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("compras.proveedor.edit",["persona"=>Persona::findOrFail($id)]);
    }
    public function update(PersonaFormRequest $request,$id)
    {
        $persona=Persona::findOrFail($id);
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->email=$request->get('email');
        $persona->update();
        return Redirect::to('compras/proveedor');
    }
    public function destroy($id)
    {
        $personas=Persona::findOrFail($id);
        $personas->tipo_persona='Inactivo';
        $personas->update();
        return Redirect::to('compras/proveedor');
    }
}
