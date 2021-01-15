@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Producto</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'almacen/producto','method'=>'POST',
				'autocomplete'=>'off','onsubmit'=>'return validar(this)','name'=>'formV','files'=>'true'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" id="nombre" class="form-control"  placeholder="Nombre...">
				<label id="lblnombre" style="display:none;color:red;">Nombre requirido</label>
			</div>
            <div class="form-group">
            	<label for="Stock">Stock</label>
				<input type="text" name="stock" id="stock" class="form-control"  placeholder="stock...">
				<label id="lblstock" style="display:none;color:red;">Stock requirido</label>
            </div>
             <div class="form-group">
            	<label for="preciounidad">Precio Unidad</label>
            	<input type="text" name="preciounidad" id="preciounidad" class="form-control" placeholder="precio unitario...">
				<label id="lblpreciounidad" style="display:none;color:red;">Precio Unidad requirido</label>
			</div>
             <div class="form-group">
                  <label for="imagen">imagen</label>
				  <input type="file" name="imagen" id="imagen" class="form-control">
				  <label id="lblimagen" style="display:none;color:red;">Imagen requirido</label>
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>


			{!!Form::close()!!}		
            
		</div>
	</div>
	<script>
      function validar(e){
        console.log("validando")
                //expresionEmail = /\w+@\w+\.+[a-z]/;  
                //expresionTelefono = /\/;  
        var nombre = document.getElementById('nombre');
        var lbnombre = document.getElementById('lblnombre');
		lbnombre.setAttribute("style", "display: none;");

		var preciounidad = document.getElementById('preciounidad');
        var lblpreciounidad = document.getElementById('lblpreciounidad');
		lblpreciounidad.setAttribute("style", "display: none;");

		var stock = document.getElementById('stock');
        var lblstock = document.getElementById('lblstock');
		lblstock.setAttribute("style", "display: none;");

		var imagen = document.getElementById('imagen');
        var lblimagen = document.getElementById('lblimagen');
		lblimagen.setAttribute("style", "display: none;");
         
        var bool = true;
          if (nombre.value.length == 0) {
				lbnombre.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.nombre.focus() 
                  bool = false;
              }
		  }
		  if (!/^\d*\.?\d*$/.test(preciounidad.value) || preciounidad.value.length== 0) {
			lblpreciounidad.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.preciounidad.focus() 
                  bool = false;
              }
		  }
		  if (!/^([0-9])*$/.test(stock.value) || stock.value.length== 0) {
			lblstock.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.stock.focus() 
                  bool = false;
              }
		  }
		  if (imagen.value.length == 0) {
			lblimagen.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.imagen.focus() 
                  bool = false;
              }
		  }
          return bool;
      }
   </script>   
@endsection