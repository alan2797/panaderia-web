@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>CONFIRMAR PEDIDO</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

		    {!!Form::model($venta,['method'=>'PATCH','route'=>['atendido.update',$venta->id_venta]])!!}
            {{Form::token()}}
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <div class="form-group">
                                    <label for="estado">Confirmar</label>
                                    <select name="estado" class="form-control">
                                                <option value="Entregando">Entregado</option>
                                                <option value="Enviado">Enviado</option>
                                                
                                                
                                    </select>
                              </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                        <label for="transporte">Transporte</label>
                        <select  name='transporte'class="form-control">
                               @foreach($transporte as $trans)
                                    <option value="{{$trans->id_transporte}}">{{$trans->modelo}}</option>
                                    
                               @endforeach
                              
                        </select>         
                        
                  </div>
               </div>
          
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection