@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cliente</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'usuario/cliente','method'=>'POST',
				'autocomplete'=>'off','onsubmit'=>'return validar(this)','name'=>'formV'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre...">
				<label id="lblnombre" style="display:none;color:red;">Nombre requirido</label>
            </div>
            <div class="form-group">
            	<label for="tipodocumento">Tipo de Documento</label>
            	<input type="text" name="tipodocumento" id="tipodocumento" class="form-control" placeholder=tipodocumento...">
				<label id="lbltipodocumento" style="display:none;color:red;">Tipo De Doc. requirido</label>
			</div>
            <div class="form-group">
            	<label for="Numero">Numero de Documento</label>
				<input type="text" name="numero_documento"  id="numero_documento"
				class="form-control" placeholder="numero...">
				<label id="lblnumero_documento" style="display:none;color:red;">Nr de Documento requirido</label>
			</div>
            <div class="form-group">
            	<label for="Direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" class="form-control" placeholder="direccion...">
				
				<label id="lbldireccion" style="display:none;color:red;">Direccion requirido</label>
            </div>
            <div class="form-group">
                  <label for="telefono">Telefono</label>
                  <input type="text" name="telefono" id="telefono" class="form-control" placeholder="telefono...">
				<label id="lbltelefono" style="display:none;color:red;">Telefono requirido</label>
            </div>
            <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email...">
				  <label id="lblemail" style="display:none;color:red;">Email requirido</label>
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

		var tipodocumento = document.getElementById('tipodocumento');
        var lbltipodocumento = document.getElementById('lbltipodocumento');
		lbltipodocumento.setAttribute("style", "display: none;");

		var numero_documento = document.getElementById('numero_documento');
        var lblnumero_documento = document.getElementById('lblnumero_documento');
		lblnumero_documento.setAttribute("style", "display: none;");

		var direccion = document.getElementById('direccion');
        var lbldireccion = document.getElementById('lbldireccion');
		lbldireccion.setAttribute("style", "display: none;");

		var telefono = document.getElementById('telefono');
        var lbltelefono = document.getElementById('lbltelefono');
		lbltelefono.setAttribute("style", "display: none;");

		var email = document.getElementById('email');
        var lblemail= document.getElementById('lblemail');
		lblemail.setAttribute("style", "display: none;");
        var bool = true;
          if (nombre.value.length == 0) {
				lbnombre.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.nombre.focus() 
                  bool = false;
              }
		  }
		  if (tipodocumento.value.length == 0) {
			lbltipodocumento.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.tipodocumento.focus() 
                  bool = false;
              }
		  }
		  if (!/^([0-9])*$/.test(numero_documento.value) || numero_documento.value.length == 0) {
			lblnumero_documento.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.numero_documento.focus() 
                  bool = false;
              }
		  }
		  if (direccion.value.length == 0) {
			lbldireccion.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.direccion.focus() 
                  bool = false;
              }
		  }
		  if (!/^([0-9])*$/.test(telefono.value) || telefono.value.length == 0) {
			lbltelefono.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.telefono.focus() 
                  bool = false;
              }
		  }
		  if (email.value.length == 0) {
			lblemail.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.email.focus() 
                  bool = false;
              }
		  }
          return bool;
      }
   </script>   
@endsection