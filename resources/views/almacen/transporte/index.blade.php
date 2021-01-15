@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Transporte <a href="transporte/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.transporte.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:{{trim(Auth::user()->color)}};color:white;font-size:17px">
					<th>Id</th>
					<th>Placa</th>
					<th>Modelo</th>
					<th>Color</th>
					<th>Descripcion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($transportes as $trans)
				<tr>
					<td>{{ $trans->id_transporte}}</td>
					<td>{{ $trans->placa}}</td>
					<td>{{ $trans->modelo}}</td>
					<td>{{ $trans->color}}</td>
					<td>{{ $trans->descripcion}}</td>
					<td>
						<a href="{{URL::action('TransporteController@edit',$trans->id_transporte)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$trans->id_transporte}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.transporte.modal')
				@endforeach
			</table>
		</div>
		{{$transportes->render()}}
	</div>
</div>

@endsection