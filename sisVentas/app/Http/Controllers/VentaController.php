<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\VentaFormRequest;
use sisVentas\Venta;
use sisVentas\Factura;
use sisVentas\DetalleFactura;
use sisVentas\Categoria;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
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
            $ventas=DB::table('venta as v')
            ->join('articulo as a','v.idarticulo','=','a.idarticulo')
            ->join('factura_comercial as f','f.idfactura','=','v.idfactura')
            ->select('v.idventa','v.orden_jormos','v.fecha','f.idfactura','f.codigo as factura','f.fecha as fecha_factura','f.total as acumulado','a.nombre as cliente','f.descuento')
            ->where('v.orden_jormos','LIKE','%'.$query.'%')
            ->where('v.estado','=','Activa')
            ->orderBy('v.idventa','desc')
            ->paginate(12);
            return view('almacen.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
        }
    }
    public function create()
    {
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
        $articulos=DB::table('articulo')->where('estado','=','Activo')->get();
    	$facturas =DB::table('factura_comercial as f')
    	->select('f.idfactura', 'f.codigo')
    	->where('f.estado','=','Activa')
    	->get();

    	
        return view('almacen.venta.create',["categorias"=>$categorias,"articulos"=>$articulos,"facturas"=>$facturas]);
    }
    public function store (VentaFormRequest $request)
    {
    	try{
    		DB::beginTransaction();
	        $venta=new Venta;
	        $venta->idfactura=$request->get('idfactura');
	        $venta->idarticulo=$request->get('idarticulo');
	        $venta->orden_jormos=$request->get('orden_jormos');
	        $venta->fecha=$request->get('fecha');
		    $venta->estado='Activa';
	        $venta->save();
           
		    DB::commit();

    	}catch(\Exception $e){
            
    		DB::rollback();
    	}
        return Redirect::to('almacen/venta
        	');

    }
    public function show($id)
    {
    	$ventas=DB::table('venta as v')
            ->join('articulo as a','v.idarticulo','=','a.idarticulo')
            ->join('factura_comercial as f','f.idfactura','=','v.idfactura')
            ->join('detalle_factura as d','d.idfactura','=','f.idfactura')
            ->select('v.idventa','a.nombre as cliente','v.orden_jormos','f.idfactura','f.codigo','f.fecha','f.descuento','d.unidad','d.cantidad','d.precio_unitario',DB::raw('sum(d.cantidad*d.precio_unitario) as total'))
            ->where('v.idventa','=',$id)
            ->first();
        $detalles=DB::table('detalle_factura as d')
        ->join('producto as p','p.idproducto','=','d.idproducto')
        ->join('factura_comercial as f','f.idfactura','=','d.idfactura')
        ->join('venta as v','v.idfactura','=','f.idfactura')
        ->select('p.nombre','d.cantidad','d.precio_unitario','d.unidad')
        ->where('v.idventa','=',$id)
        ->get();

        return view('almacen.venta.show',["ventas"=>$ventas,"detalles"=>$detalles]);
    }
    public function edit($id)
    {
        return view("almacen.ventas.edit",["facturas"=>Factura::findOrFail($id)]);
    }
    public function update(VentaFormRequest $request,$id)
    {
        $venta=Venta::findOrFail($id);
        $venta->idfactura=$request->get('idfactura');
        $venta->idarticulo=$request->get('idarticulo');
        $venta->orden_jormos=$request->get('orden_jormos');
        $venta->total=$request->get('total');
    	$fecha->fecha=$request->get('fecha');
       
        $venta->update();
        return Redirect::to('almacen/venta');
    }
    public function destroy($id)
    {
        $venta=Venta::findOrFail($id);
        $venta->estado='Cancelada';
        $venta->update();
        return Redirect::to('almacen/venta');
    }
}
