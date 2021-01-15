@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo insumo</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'almacen/insumo','method'=>'POST',
						'autocomplete'=>'off','onsubmit'=>'return validar(this)','name'=>'formV','files'=>'true'))!!}
            {{Form::token()}}

            <div class="form-group">
            	<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" class="form-control"  
					placeholder="Nombre...">
				<label id="lblnombre" style="display:none;color:red;">Nombre requirido</label>
            </div>
            <div class="form-group">
            	<label for="Stock">descripcion</label>
				<input type="text" name="descripcion" id="descripcion" class="form-control" 
				 placeholder="descripcion...">
				<label id="lbldescripcion" style="display:none;color:red;">Descripcion requirido</label>
            </div>
             <div class="form-group">
            	<label for="preciounidad">Stock</label>
				<input type="text" name="Stockkg"  id="Stockkg" class="form-control" 
				placeholder="stock...">
				<label id="lblStockkg" style="display:none;color:red;">Stockkg requirido</label>
            </div>
            <div class="form-group">
                  <label for="preciounidad">imagen</label>
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

		var descripcion = document.getElementById('descripcion');
        var lbldescripcion = document.getElementById('lbldescripcion');
		lbldescripcion.setAttribute("style", "display: none;");

		var Stockkg = document.getElementById('Stockkg');
        var lblStockkg = document.getElementById('lblStockkg');
		lblStockkg.setAttribute("style", "display: none;");

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
		  if (descripcion.value.length == 0) {
			lbldescripcion.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.descripcion.focus() 
                  bool = false;
              }
		  }
		  if (!/^([0-9])*$/.test(Stockkg.value) || Stockkg.value.length == 0) {
			lblStockkg.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.Stockkg.focus() 
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