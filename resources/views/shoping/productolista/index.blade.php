@extends ('layouts.app')
@section ('content')
<div class="container">
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Ventas <a href="productolista/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('shoping.productolista.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>fecha</th>
					<th>cliente</th>
					<th>Tipo de comprobante</th>
					<th>numero de comprobante</th>
					<th>inpuesto</th>
					<th>Total</th>
					<th>estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ventas as $ven)
				<tr>
					<td>{{ $ven->id_venta}}</td>
					<td>{{ $ven->fecha_hora}}</td>
					<td>{{ $ven->nombre}}</td>
					<td>{{ $ven->tipo_comprobante}}</td>
					<td>{{ $ven->num_comprobante}}</td>
					<td>{{ $ven->impuesto}}</td>
					<td>{{ $ven->total_venta}}</td>
					<td>{{ $ven->estado}}</td>

					<td>
						<a href="{{URL::action('VentaController@show',$ven->id_venta)}}"><button class="btn btn-primary">Detalles</button></a>
                         <a href="" data-target="#modal-delete-{{$ven->id_venta}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('shoping.productolista.modal')
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}

	</div>
</div>
</div>

@endsection