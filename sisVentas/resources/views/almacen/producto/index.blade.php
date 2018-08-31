@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Productos <a href="producto/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.producto.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					
					<th>Codigo</th>
					<th>SKU</th>
					<th>Nombre</th>
					<th>Fabricante</th>
					<th>Descripcion</th>
					<th>Partida Arancelaria</th>
					<th>Estado</th>
					<th>Opciones</th>
				
				</thead>
               @foreach ($productos as $art)
				<tr>
					
					<td>{{ $art->codigo}}</td>
					<td>{{ $art->sku}}</td>
					<td>{{ $art->nombre}}</td>
					<td>{{ $art->fabricante}}</td>
					<td>{{ $art->descripcion}}</td>
					<td>{{ $art->partida_arancelaria}}</td>
					<td>{{ $art->estado}}</td>
				
					<td>
						<a href="{{URL::action('ProductoController@edit',$art->idproducto)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$art->idproducto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.producto.modal')
				@endforeach
			</table>
		</div>
		{{$productos->render()}}
	</div>
</div>

@endsection