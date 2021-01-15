
@extends ('layouts.admin')
@section ('contenido')	
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de Clientes Mas Frecuentes</h2>
            </div>
            <form  method="post">
               {{method_field('post')}}
               {{csrf_field()}}
              <div class="pull-right" style="margin: 10px">
                 <button type="submit" class="btn btn-danger" >Descargar PDF</button>
              </div>
               <div class="pull-right" style="margin: 10px">
                <label>Fecha Inicio</label>
                  <input type="date" name="fechaini" id="fechaini">
                 
              </div>

              <div class="pull-right" style="margin: 10px">
                <label>Fecha Fin</label>
                  <input type="date" name="fechafin" id="fechafin">
                 
              </div>
            </form>
            

        </div>
 </div>

<div class="table-responsive table table-hover" >
<table class="table table-striped table-bordered table-condensed table-hover">
    <thead class="thead-dark" style="background-color:#3c8dbc;color:white;font-size:17px">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Direccion</th>
        <th scope="col">Documento</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Monto Total Consumido</th>
      </tr>
    </thead>
    <tbody>
     @foreach ($clientes as $key => $cliente)
		   <tr>
		     <td>{{ $key+1 }}</td>
		     <td>{{ $cliente->nombre }}</td>
		     <td>{{ $cliente->direccion }}</td>
		     <td>{{ $cliente->telefono }}</td>
		     <td>{{ $cliente->numero_documento }}</td>
		     <td>{{ $cliente->email }}</td>
		     <td>{{ $cliente->total_venta }} Bs.</td>
		   </tr>     
	 @endforeach
    </tbody>
  </table>
</div>

@endsection