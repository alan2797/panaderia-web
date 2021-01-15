
@extends ('layouts.admin')
@section ('contenido')	
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de Productos Mas Vendidos</h2>
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
        <th scope="col">Stock de Producto</th>
        <th scope="col">Precio X Unidad Bs.</th>
        <th scope="col">Total Vendido</th>
        <th scope="col">Foto</th>
      </tr>
    </thead>
    <tbody>
     @foreach ($productos as $key => $producto)
		   <tr>
		     <td>{{ $key+1 }}</td>
		     <td>{{ $producto->nombre }}</td>
		     <td>{{ $producto->stock }}</td>
		     <td>{{ $producto->preciounidad }}</td>
		     <td>{{ $producto->total}} Bs.</td>
		     <td>
            <img src="{{asset('imagenes/productos/'.$producto->imagen)}}" alt="{{$producto->nombre}}" height="100px" width="100px" class="img-thumbnail">
          </td>
		   </tr>     
	 @endforeach
    </tbody>
  </table>
</div>

@endsection