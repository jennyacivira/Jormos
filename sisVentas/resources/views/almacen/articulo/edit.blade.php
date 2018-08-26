@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente: {{ $articulo->nombre}}</h3>
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
			{!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idarticulo],'files'=>'true'])!!}
            {{Form::token()}}
             <div class="row">
            	<div class="col-lg-6 col col-md col-xs-12">
            		<div class="form-group">
                    	<label for="nombre">Nombre</label>
                    	<input type="text" name="nombre" requerid value="{{$articulo->nombre}}"class="form-control" >
                    </div>
    	       </div>	
            	<div class="col-lg-6 col col-md col-xs-12">
            		<div class="form-group">
            			<label>Categoria</label>
            			<select name="idcategoria" class="form-control">
            			@foreach ($categorias as $cat)
            				@if ($cat->idcategoria==$articulo->idcategoria)
            				<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
                            @else
                            <option value="{{$cat->idcategoria}}" >{{$cat->nombre}}</option>
                            @endif
            			@endforeach 
            			</select>
            		</div>
            	</div>	
            	<div class="col-lg-6 col col-md col-xs-12">
            		<div class="form-group">
                    	<label for="codigo">Codigo</label>
                    	<input type="text" name="codigo" requerid value="{{$articulo->codigo}}"class="form-control">
                    </div>
            	</div>	

            	<div class="col-lg-6 col col-md col-xs-12">
            		<div class="form-group">
                    	<label for="descripcion">Descripcion</label>
                    	<input type="text" name="descripcion" requerid value="{{$articulo->descripcion}}"class="form-control" >
                    </div>
            	</div>	
                <div class="col-lg-6 col col-md col-xs-12">
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" requerid value="{{$articulo->direccion}}"class="form-control" >
                    </div>
                </div>  
                <div class="col-lg-6 col col-md col-xs-12">
                    <div class="form-group">
                        <label for="razon_social">Razon Social</label>
                        <input type="text" name="razon_social" requerid value="{{$articulo->razon_social}}"class="form-control" >
                    </div>
                </div>  
                <div class="col-lg-6 col col-md col-xs-12">
                    <div class="form-group">
                        <label for="ruc">RUC</label>
                        <input type="text" name="ruc" requerid value="{{$articulo->ruc}}"class="form-control" >
                    </div>
                </div>  
                 <div class="col-lg-6 col col-md col-xs-12">
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="number" name="telefono" requerid value="{{$articulo->telefono}}"class="form-control">
                    </div>
                </div>  
                 <div class="col-lg-6 col col-md col-xs-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" requerid value="{{$articulo->email}}"class="form-control">
                    </div>
                </div>  
            	<!-- <div class="col-lg-6 col col-md col-xs-12">
            		<div class="form-group">
            			<label for="imagen">Imagen</label>
            			<input type="file" name="imagen" class="form-control">
                        @if (($articulo->imagen)!="")
                            <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="300px" width="300px">
                        @endif
            		</div>
            	</div>	
 -->        </div> 
            <div class="row">
                <div class="col-lg-6 col col-md col-xs-12">
                    <div class="form-group"></div>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>  

            </div> 



			{!!Form::close()!!}		
            
		
@endsection