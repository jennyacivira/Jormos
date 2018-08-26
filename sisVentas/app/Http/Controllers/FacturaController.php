<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\FacturaFormRequest;
use sisVentas\Factura;
use sisVentas\DetalleFactura;
use sisVentas\Categoria;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class FacturaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $facturas=DB::table('factura_comercial as f')
            ->join('articulo as a','f.idarticulo','=','a.idarticulo')
            ->select('f.idfactura','f.codigo as codigo_factura','f.fecha','a.nombre as cliente')
            ->where('f.codigo','LIKE','%'.$query.'%')
            ->orderBy('f.idfactura','desc') 
            ->paginate(12);
            return view('almacen.factura.index',["facturas"=>$facturas,"searchText"=>$query]);
        }
    }
    public function create()
    {
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        $articulos=DB::table('articulo')->where('estado','=','Activo')->get();
    	$productos =DB::table('producto as p')
    	->select(DB::raw('CONCAT(p.codigo," ",p.nombre) AS producto'),'p.idproducto')
    	->where('p.estado','=','Activo')
    	->get();
        return view('almacen.factura.create',["categorias"=>$categorias,"articulos"=>$articulos,"productos"=>$productos]);
    }
    public function store (FacturaFormRequest $request)
    {
    	try{
    		DB::beginTransaction();
	        $factura=new Factura;
	        $factura->codigo=$request->get('codigo');
            $factura->idarticulo=$request->get('idarticulo');

	     //    $mytime = Carbon::now('America/Lima');
		    // $factura->fecha=$mytime->toDateTimeString();
           
		    $factura->estado='Activa';

            $factura->total=$request->get('txtTotal');

            $factura->fecha=$request->get('date');

	        $factura->save();
           

            $idproducto=$request->get('idproducto');
            
            $cantidad=$request->get('cantidad');
            
            $precio_unitario = $request->get('precio_unitario');
        
            $unidad=$request->get('unidad');



         

	        $cont = 0;

	        while($cont < count($idproducto)){
                $detalle = new DetalleFactura();
                $detalle->idfactura=$factura->idfactura;
                $detalle->idproducto=$idproducto[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_unitario=$precio_unitario[$cont];
                $detalle->unidad=$unidad[$cont];
                $detalle->save();
              
	        	$cont=$cont +1;
	        } 

		    DB::commit();

    	}catch(\Exception $e){
            
    		DB::rollback();
    	}
        return Redirect::to('almacen/factura');

    }
    public function show($id)
    {
    	$facturas=DB::table('factura_comercial as f')
            ->join('articulo as a','f.idarticulo','=','a.idarticulo')
            ->join('detalle_factura as d','d.idfactura','=','f.idfactura')
            ->select('f.idfactura','a.nombre as cliente','f.codigo','f.fecha','f.total')
            ->where('f.idfactura','=',$id)
            ->first();
        $detalles=DB::table('detalle_factura as d')
        ->join('producto as p','p.idproducto','=','d.idproducto')
        ->join('factura_comercial as f','f.idfactura','=','d.idfactura')
        ->select('p.nombre','d.cantidad','d.precio_unitario','d.unidad')
        ->where('d.idfactura','=',$id)
        ->get();

        return view('almacen.factura.show',["facturas"=>$facturas,"detalles"=>$detalles]);
    }
    public function edit($id)
    {
        return view("almacen.factura.edit",["facturas"=>Factura::findOrFail($id)]);
    }
    public function update(FacturaFormRequest $request,$id)
    {
        $factura=Factura::findOrFail($id);
        $factura->idfactura=$request->get('idfactura');
        $factura->idarticulo=$request->get('idarticulo');
        $factura->idproducto=$request->get('idproducto');
        $factura->precio_unitario=$request->get('precio_unitario');
        $factura->codigo=$request->get('codigo');
        $factura->precio_unitario=$request->get('precio_unitario');
        $factura->cantidad=$request->get('cantidad');
       
        $factura->update();
        return Redirect::to('almacen/factura');
    }
    public function destroy($id)
    {
        $factura=Factura::findOrFail($id);
        $factura->estado='Cancelada';
        $factura->update();
        return Redirect::to('almacen/factura');
    }
}
