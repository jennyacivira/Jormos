@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Factura</h3>
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

			{!!Form::open(array('url'=>'almacen/factura','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
    		<div class="form-group">
            	<label for="fabricante">Fabricante</label>
            	<select name="idcategoria" id="idcategoria" class="form-control selectpicker" data-live-search="true">
                 @foreach($categorias as $cat)
                  <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>   
                  @endforeach
                </select>
            </div>
    	</div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="fabricante">Cliente</label>
                <select name="idarticulo" id="idarticulo" class="form-control selectpicker" data-live-search="true">
                 @foreach($articulos as $art)
                  <option value="{{$art->idarticulo}}">{{$art->nombre}}</option>   
                  @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                <div class="form-group">
                    <label for="codigo">Codigo Factura</label>
                    <input type="text" name="codigo"  class="form-control" required>
                </div>
         </div>
         <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                <div class="form-group">
            
                    <label for="date">Fecha</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="date" required>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>

                </div>
         </div>
        </div>
    	<div class="row">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="form-group">
                            <label for="producto">Producto</label>
                                <select name="pidproducto" id="pidproducto" class="form-control selectpicker" data-live-search="true">
                                 @foreach($productos as $pro)
                                  <option value="{{$pro->idproducto}}">{{$pro->producto}}</option> 
                                @endforeach  
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                          <label for="cantidad">Cantidad</label>
                            <input type="number" name="pcantidad" id="pcantidad" class="form-control"  placeholder="Cantidad">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                            <label for="precio_unitario">Precio Unitario</label>
                            <input type="number" name="pprecio" id="pprecio" class="form-control"  placeholder="Precio Unitario">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                            <label for="unidad">Unidad</label>
                            <input type="text" name="punidad" id="punidad" class="form-control"  placeholder="Unidad">   
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                            <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>  
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                                <th>Opciones</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>FOB</th>
                                <th>Unidad</th>
                                <th>Subtotal</th>
                            </thead>
                            <tfoot>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total">$/. 0.00</h4></th>
                                <th><input name="txtTotal" type="hidden" id="txtTotal" value="" ></th>
                            </tfoot>
                            
                        </table>
                    </div>
                </div>
            </div>
        			 	
                
       
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
                <div class="form-group">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    
                	<button class="btn btn-primary" type="submit">Guardar</button>
                	<button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
        </div>
</div>
			{!!Form::close()!!}		
            

@push('scripts')
  <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-standalone.css')}}">
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

<script >

    $(document).ready(function(){
        $('#bt_add').click(function(){
            agregar();
        })
    })
    var cont=0;
    total=0;
    subtotal=[];
    $("#guardar").hide();

    function agregar(){
        idproducto=$("#pidproducto").val();
        producto=$("#pidproducto option:selected").text();
        precio=$("#pprecio").val();
        cantidad=$("#pcantidad").val();
        unidad=$("#punidad").val();

        if(idproducto!="" && cantidad!="" && cantidad>0 && precio!="" )
        {
            subtotal[cont]=(cantidad*precio);
            total=total+subtotal[cont];
           

            var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button</td><td><input type="hidden" name="idproducto[]" value="'+idproducto+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_unitario[]" value="'+precio+'"></td><td><input type="text" name="unidad[]" value="'+unidad+'"></td><td>'+subtotal[cont]+'</td></tr>';    
            cont++;

            limpiar();
            $("#total").html("$. " +total);

            evaluar();
            $('#detalles').append(fila);

            $("#txtTotal").val(total); 

        }
        else{
            alert("Error al ingresar los detalles del ingreso, revise los datos del producto ");
        }

            
    }

    function limpiar(){
        $("#pcantidad").val("");
        $("#pprecio").val("");
        $("#punidad").val("");
    }

    function evaluar()
    {
        if(total>0)
        {
            $("#guardar").show();

        }else
        {
            $("#guardar").hide();
        }
    }
    function eliminar(index){
        total=total-subtotal[index];
        $("#total").html("$" + total);
        $("#fila" +index).remove();
        evaluar();
    }

    $('.datepicker').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });


</script>
@endpush
@endsection