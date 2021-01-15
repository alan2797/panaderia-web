@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>PEDIDOS A CONFIRMAR</h3>
		@include('ventas.venta.search')
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
						<a href="{{URL::action('ConfirmarVentaController@show',$ven->id_venta)}}"><button class="btn btn-primary">Detalle</button></a>
						<a href="{{URL::action('ConfirmarVentaController@edit',$ven->id_venta)}}"><button class="btn btn-info">Confirmar</button></a>
                        
					</td>
				</tr>
				@include('ventas.venta.modal')
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}

	</div>
</div>

@endsection