@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Transaporte</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'almacen/transporte',
			'method'=>'POST','autocomplete'=>'off','onsubmit'=>'return validar(this)','name'=>'formV'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="placa">Placa</label>
				<input type="text" name="placa" id="placa" class="form-control" placeholder="placa...">
				<label id="lblplaca" style="display:none;color:red;">Placa requirido</label>
            </div>
            <div class="form-group">
            	<label for="Modelo">Modelo</label>
            	<input type="text" name="modelo" id="modelo" class="form-control" placeholder=modelo...">
				<label id="lblmodelo" style="display:none;color:red;">Modelo requirido</label>
			</div>
            <div class="form-group">
            	<label for="color">Color</label>
				<input type="text" name="color2" id="color2" class="form-control" placeholder="color...">
				<label id="lblcolor" style="display:none;color:red;">Color requirido</label>
            </div>
            <div class="form-group">
            	<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="descripcion...">
				<label id="lbldescripcion" style="display:none;color:red;">Descripcion requirido</label>
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
        var placa = document.getElementById('placa');
        var lblplaca = document.getElementById('lblplaca');
		lblplaca.setAttribute("style", "display: none;");

		var modelo = document.getElementById('modelo');
        var lblmodelo = document.getElementById('lblmodelo');
		lblmodelo.setAttribute("style", "display: none;");

		var color = document.getElementById('color2');
        var lblcolor = document.getElementById('lblcolor');
		lblcolor.setAttribute("style", "display: none;");

		var descripcion = document.getElementById('descripcion');
        var lbldescripcion = document.getElementById('lbldescripcion');
		lbldescripcion.setAttribute("style", "display: none;");
         
        var bool = true;
          if (placa.value.length == 0) {
				lblplaca.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.placa.focus() 
                  bool = false;
              }
		  }
		  if (modelo.value.length == 0) {
			lblmodelo.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.modelo.focus() 
                  bool = false;
              }
		  }
		  if (color.value.length == 0) {
			lblcolor.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.color.focus() 
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
          return bool;
      }
   </script>   
@endsection