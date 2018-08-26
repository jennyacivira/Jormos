@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Facturas <a href=factura/create><button class="btn btn-success">Nueva</button></a></h3>
		@include('almacen.factura.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Codigo</th>
					<th>Fecha</th>				
					<th>Cliente</th>
					<th>Opciones</th>
				</thead>
               @foreach ($facturas as $fact)
				<tr>
					<td>{{ $fact->codigo_factura}}</td>
					<td>{{ $fact->fecha}}</td>
					<td>{{ $fact->cliente}}</td>
					<td>
						<a href="{{URL::action('FacturaController@show',$fact->idfactura)}}"><button class="btn btn-primary">Detalles</button></a>
                        <a href="" data-target="#modal-delete-{{$fact->idfactura}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('almacen.factura.modal')
				@endforeach
			</table>
		</div>
		{{$facturas->render()}}
	</div>
</div>

@endsection