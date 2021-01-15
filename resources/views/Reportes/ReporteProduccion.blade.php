
@extends ('layouts.admin')
@section ('contenido')	
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de Producciones Realizados</h2>
            </div>
        </div>
 </div>

<div class="table-responsive table table-hover" >
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
						<a href="{{URL::action('ReporteProduccionController@show',$prod->id_produccion)}}"><button class="btn btn-danger">Exportar PDF</button></a>  
					</td>
				</tr>
				@endforeach
			</table>
</div>

@endsection