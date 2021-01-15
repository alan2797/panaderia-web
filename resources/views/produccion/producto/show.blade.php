@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
             <div class="form-group">
             <label for="nombre">Encargado</label>
                <p>{{$producciones->empleado}}</p>
             </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
             <div class="form-group">
              <label for="nombre">Producto</label>
                <p>{{$producciones->producto}}</p>
             </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="tipodocumento">fecha de produccion</label>
                   <p>{{$producciones->fecha_produccion}}</p>
            </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="Numero comprobante">Cantidad producida enla fecha</label>
               <p>{{$producciones->cantidad}}</p>
            </div>
             </div>
              </div>
                      <div class="row">
               
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                      <thead style="background-color:#A9D0F5">
                                       
                                         <th>Insumo</th>
                                         <th>Cantidad</th>
                                         
                                      </thead>
                                      <tfoot>
                                        
                                         <th></th>
                                         <th></th>
                                         
                                      </tfoot>
                                      <tbody>
                                           @foreach($detalles as $det)
                                           <tr>
                                             <th>{{$det->insumo}}</th>
                                             <th>{{$det->cantidadkg}}</th>
                                             
                                            </tr>
                                           @endforeach
                                      </tbody>
                                    </table>
                               </div>
                        </div>
      </div>
                   
  </div>            
@endsection