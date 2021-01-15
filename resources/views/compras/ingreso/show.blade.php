@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
            <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
             <div class="form-group">
              <label for="nombre">Proveedor</label>
                <p>{{$ingreso->nombre}}</p>
             </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="tipodocumento">Tipo de comprobante</label>
                   <p>{{$ingreso->tipo_comprobante}}</p>
            </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="Numero comprobante">Numero de comprobante</label>
               <p>{{$ingreso->numero_comprobante}}</p>
            </div>
             </div>
              </div>
                      <div class="row">
               
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                      <thead style="background-color:#A9D0F5">
                                       
                                         <th>Insumo</th>
                                         <th>Cantidad</th>
                                         <th>precio de compra</th>
                                         <th>Subtotal</th>
                                      </thead>
                                      <tfoot>
                                        
                                         <th></th>
                                         <th></th>
                                         <th></th>
                                         <th><h4 id="total">{{$ingreso->total}}</h4></th>
                                      </tfoot>
                                      <tbody>
                                           @foreach($detalles as $det)
                                           <tr>
                                             <th>{{$det->insumo}}</th>
                                             <th>{{$det->cantidad}}</th>
                                              <th>{{$det->precio_compra}}</th>
                                             <th>{{$det->cantidad*$det->precio_compra}}</th>
                                            </tr>
                                           @endforeach
                                      </tbody>
                                    </table>
                               </div>
                        </div>
      </div>
                   
  </div>            
@endsection