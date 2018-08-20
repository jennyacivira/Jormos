@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Acumulado de Ventas <a href=venta/create><button class="btn btn-success">Nueva</button></a></h3>
		@include('almacen.venta.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					
					<th>Orden Jormos</th>
					<th>Fecha</th>
					<th>Factura</th>
					<th>Cliente</th>
					<th>Acumulado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ventas as $ven)
				<tr>
					
					<td>{{ $ven->orden_jormos}}</td>
					<td>{{ $ven->fecha}}</td>
					<td>{{ $ven->factura}}</td>
				    <td>{{ $ven->cliente}}</td>
				    <td>{{ $ven->acumulado}}</td>

					<td>
						<a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary">Detalles</button></a>
                        <a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('almacen.venta.modal')
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}
	</div>
</div>

@endsection