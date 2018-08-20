@extends ('layouts.admin')
@section ('contenido')
<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Factura: {{$facturas->codigo}}</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
	
    <div class="row">
    	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    		<div class="form-group">
            	<label for="fabricante">Cliente</label>
            	<p>{{$facturas->cliente}}</p>
            </div>
    	</div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <p>{{$facturas->codigo}}</p>
                </div>
         </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <p>{{$facturas->fecha}}</p>
                </div>
         </div>
        </div>
    	<div class="row">
            <div class="panel panel-primary">
                <div class="panel-body">
                    
        
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Unidad</th>
                                <th>Subtotal</th>
                            </thead>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total">{{$facturas->total}}</h4></th>
                            </tfoot>
                            <tbody>
                                @foreach($detalles as $det)
                                <tr>
                                    <td>{{$det->nombre}}</td>
                                    <td>{{$det->cantidad}}</td>
                                    <td>{{$det->precio_unitario}}</td>
                                    <td>{{$det->unidad}}</td>
                                    <td>{{$det->cantidad*$det->precio_unitario}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        			 	
                
       
            
</div>
			
@endsection