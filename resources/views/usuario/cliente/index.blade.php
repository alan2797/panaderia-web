@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Cliente <a href="cliente/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('usuario.cliente.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:#3c8dbc;color:white;font-size:17px">
					<th>Id</th>
					<th>Nombre</th>
					<th>Tipo de documeto</th>
					<th>Numero de Documento</th>
					<th>Direccion</th>
					<th>telefono</th>
					<th>Email</th>
					<th>Opciones</th>
				</thead>
               @foreach ($clientes as $client)
				<tr>
					<td>{{ $client->id_persona}}</td>
					<td>{{ $client->nombre}}</td>
					<td>{{ $client->tipodocumento}}</td>
					<td>{{ $client->numero_documento}}</td>
					<td>{{ $client->direccion}}</td>
					<td>{{ $client->telefono}}</td>
					<td>{{ $client->email}}</td>

					<td>
						<a href="{{URL::action('ClienteController@edit',$client->id_persona)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$client->id_persona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('usuario.cliente.modal')
				@endforeach
			</table>
		</div>
		{{$clientes->render()}}

	</div>
</div>

@endsection