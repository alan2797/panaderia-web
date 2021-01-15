@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Insumo: {{$insumo->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

		{!!Form::model($insumo,['method'=>'PATCH','route'=>['insumo.update',$insumo->id_insumo],'files'=>true])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" class="form-control" value="{{$insumo->nombre}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
            	<label for="Descripcion">Descripcion</label>
            	<input type="text" name="descripcion" class="form-control" value="{{$insumo->descripcion}}" placeholder="descripcion...">
            </div>
             <div class="form-group">
            	<label for="preciounidad">Stock</label>
            	<input type="text" name="Stockkg" class="form-control" value="{{$insumo->stockkg}}" placeholder="Stock...">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                        <label for="imagen">Imagen</label>
                              <input type="file" name="imagen" class="form-control" value="{{$insumo->imagen}}">
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