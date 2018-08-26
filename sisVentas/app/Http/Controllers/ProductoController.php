<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\ProductoFormRequest;
use sisVentas\Producto;
use DB;

class ProductoController extends Controller
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
            $productos=DB::table('producto as p')
            ->join('categoria as c','p.idcategoria','=','c.idcategoria')
            ->select('p.idproducto','p.nombre','p.codigo','c.nombre as fabricante','p.estado','p.descripcion','p.partida_arancelaria')
            ->where('p.codigo','LIKE','%'.$query.'%')
            ->where ('p.estado','=','Activo')
            ->orderBy('p.idproducto','desc')
            ->paginate(12);
            return view('almacen.producto.index',["productos"=>$productos,"searchText"=>$query]);
        }
    }
    public function create()
    {
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.producto.create",["categorias"=>$categorias]);
    }
    public function store (ProductoFormRequest $request)
    {
        $producto=new Producto;
        $producto->idcategoria=$request->get('idcategoria');
        $producto->nombre=$request->get('nombre');
        $producto->codigo=$request->get('codigo');
        $producto->descripcion=$request->get('descripcion');    
        $producto->partida_arancelaria=$request->get('partida_arancelaria');
        $producto->estado='Activo';

        $producto->save();
        return Redirect::to('almacen/producto');

    }
    public function show($id)
    {
        return view("almacen.producto.show",["producto"=>Producto::findOrFail($id)]);
    }
    public function edit($id)
    {
    	$producto=Producto::findOrFail($id);
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.producto.edit",["producto"=>$producto,"categorias"=>$categorias]);
    }
    public function update(ProductoFormRequest $request,$id)
    {
        $producto=Producto::findOrFail($id);
        $producto->idproducto=$request->get('idproducto');
        $producto->nombre=$request->get('nombre');
        $producto->codigo=$request->get('codigo');
        $producto->descripcion=$request->get('descripcion');    
        $producto->partida_arancelaria=$request->get('partida_arancelaria');
       
        $producto->update();
        return Redirect::to('almacen/producto');
    }
    public function destroy($id)
    {
        $producto=Producto::findOrFail($id);
        $producto->estado='Inactivo';
        $producto->update();
        return Redirect::to('almacen/producto');
    }
}
