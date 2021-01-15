@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto: {{$producto->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

		{!!Form::model($producto,['method'=>'PATCH','route'=>['producto.update',$producto->id_producto],'files'=>true])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" class="form-control" value="{{$producto->nombre}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
            	<label for="Stock">Stock</label>
            	<input type="text" name="stock" class="form-control" value="{{$producto->stock}}" placeholder="stock...">
            </div>
             <div class="form-group">
            	<label for="preciounidad">Precio Unidad</label>
            	<input type="text" name="preciounidad" class="form-control" value="{{$producto->preciounidad}}" placeholder="precio unitario...">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                        <label for="imagen">Imagen</label>
                              <input type="file" name="imagen" class="form-control" value="{{$producto->imagen}}">
                  </div>
             </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection