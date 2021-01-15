@extends ('layouts.app')
@section ('content')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
            <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
             <div class="form-group">
            	<label for="nombre">Cliente</label>
                <p>{{$venta->nombre}}</p>
             </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
            	<label for="tipodocumento">Tipo de comprobante</label>
            	     <p>{{$venta->tipo_comprobante}}</p>
            </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
            	<label for="Numero comprobante">Numero de comprobante</label>
            	 <p>{{$venta->num_comprobante}}</p>
            </div>
             </div>
              </div>
                      <div class="row">
               
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                      <thead style="background-color:#A9D0F5">
                                       
                                         <th>producto</th>
                                         <th>Cantidad</th>
                                         <th>precio de Venta</th>
                                         <th>Descuento</th>
                                         <th>Subtotal</th>
                                      </thead>
                                      <tfoot>
                                        
                                         <th></th>
                                         <th></th>
                                         <th></th>
                                         <th></th>
                                         <th><h4 >{{$venta->total_venta}}</h4></th>
                                      </tfoot>
                                      <tbody>
                                           @foreach($detalles as $det)
                                           <tr>
                                             <th>{{$det->producto}}</th>
                                             <th>{{$det->cantidad}}</th>
                                              <th>{{$det->costo}}</th>
                                              <th>{{$det->descuento}}</th>
                                             <th>{{$det->cantidad*$det->costo-$det->descuento}}</th>
                                            </tr>
                                           @endforeach
                                      </tbody>
                                    </table>
                               </div>
                        </div>
      </div>
                   
  </div>            
@endsection