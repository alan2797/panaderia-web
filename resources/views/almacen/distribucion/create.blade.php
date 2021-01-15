@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Distribucion</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'almacen/distribucion','method'=>'POST',
				'autocomplete'=>'off','onsubmit'=>'return validar(this)','name'=>'formV'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="tipo de Envio">Tipo de Envio</label>
            	<input type="text" name="tipo_envio" id="tipo_envio" class="form-control" placeholder="tipo de envio...">
				<label id="lbltipo_envio" style="display:none;color:red;">Tipo Envio requirido</label>
			</div>
            <div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción...">
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
		var tipo_envio = document.getElementById('tipo_envio');
        var lbltipo_envio = document.getElementById('lbltipo_envio');
		lbltipo_envio.setAttribute("style", "display: none;");

		var descripcion = document.getElementById('descripcion');
        var lbldescripcion = document.getElementById('lbldescripcion');
		lbldescripcion.setAttribute("style", "display: none;");
         
        var bool = true;
          if (tipo_envio.value.length == 0) {
			lbltipo_envio.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.tipo_envio.focus() 
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