@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Distribuciones <a href="distribucion/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.distribucion.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:{{trim(Auth::user()->color)}};color:white;font-size:17px">
					<th>Id</th>
					<th>Tipo de Envio</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
               @foreach ($distribucion as $distri)
				<tr>
					<td>{{ $distri->id_distribucion}}</td>
					<td>{{ $distri->tipo_envio}}</td>
					<td>{{ $distri->descripcion}}</td>
					<td>
						<a href="{{URL::action('DistribucionController@edit',$distri->id_distribucion)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$distri->id_distribucion}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.distribucion.modal')
				@endforeach
			</table>
		</div>
		{{$distribucion->render()}}
	</div>
</div>

@endsection