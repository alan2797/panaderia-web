@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Produccion<a href="producto/create"><button class="btn btn-success">Nuevo Produccion</button></a></h3>
		@include('produccion.producto.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:#3c8dbc;color:white;font-size:17px">
					<th>Id</th>
					<th>fecha de produccion</th>
					<th>Cantidad</th>
					<th>Encargado</th>
					<th>Produto</th>
					<th>Opciones</th>
				</thead>
               @foreach ($producciones as $prod)
				<tr>
					<td>{{ $prod->id_produccion}}</td>
					<td>{{ $prod->fecha_produccion}}</td>
					<td>{{ $prod->cantidad}}</td>
					<td>{{ $prod->empleado}}</td>
					<td>{{ $prod->producto}}</td>
					
					<td>
						<a href="{{URL::action('DetalleproductoController@show',$prod->id_produccion)}}"><button class="btn btn-primary">Ver Detalles</button></a>
                         
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$producciones->render()}}

	</div>
</div>

@endsection