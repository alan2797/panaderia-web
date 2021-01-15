@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de productos <a href="producto/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.producto.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:{{trim(Auth::user()->color)}};color:white;font-size:17px">
					<th>Id</th>
					<th>Nombre</th>
					<th>Stock</th>
					<th>Precio por unidad</th>
					<th>estado</th>
					<th>imagen</th>
					<th>Opciones</th>
				</thead>
               @foreach ($productos as $pro)
				<tr>
					<td>{{ $pro->id_producto}}</td>
					<td>{{ $pro->nombre}}</td>
					<td>{{ $pro->stock}}</td>
					<td>{{ $pro->preciounidad}}</td>
					<td>{{ $pro->estado}}</td>

					<td>
						<img src="{{asset('imagenes/productos/'.$pro->imagen)}}" alt="{{$pro->nombre}}" height="100px" width="100px" class="img-thumbnail">
					</td>
					<td>
						<!--metodo URL de laravelllama la accion alcontrolador de producto al metodo edit-->
						<a href="{{URL::action('ProductoController@edit',$pro->id_producto)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$pro->id_producto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
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