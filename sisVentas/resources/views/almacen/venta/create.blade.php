@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Venta</h3>
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

			{!!Form::open(array('url'=>'almacen/venta','method'=>'POST','autocomplete'=>'off'))!!}
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
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
            <div class="form-group">
                <label for="cliente">Cliente</label>
                <select name="idarticulo" id="idarticulo" class="form-control selectpicker" data-live-search="true">
                 @foreach($articulos as $art)
                  <option value="{{$art->idarticulo}}">{{$art->nombre}}</option>   
                  @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
            <div class="form-group">
                <label for="factura">Facturas</label>
                <select name="idfactura" id="idfactura" class="form-control selectpicker" data-live-search="true">
                 @foreach($facturas as $fact)
                  <option value="{{$fact->idfactura}}">{{$fact->codigo}}</option>   
                  @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                <div class="form-group">
                    <label for="orden_jormos">Codigo Jormos</label>
                    <input type="text" name="orden_jormos"  class="form-control" required>
                </div>
         </div>
         <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="fecha" required>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>

                </div>
         </div>
        </div>
    	<div class="row"> 
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
                <div class="form-group">
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

    $('.datepicker').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });   
    </script>
    @endpush
    @endsection