
@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3>Nueva Compra</h3>
      @if (count($errors)>0)
      <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
        </ul>
      </div>
      @endif

      {!!Form::open(array('url'=>'shoping/shopincar','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
             <div class="form-group">
              <label for="nombre">USUARIO</label>
              <select name="id_persona" id="id_persona" class="form-control selectpicker" data-Live-search="true">
                    @foreach($personas as $persona)
                     <option value="{{$persona->id_persona}}">{{$persona->nombre}}</option>
                    @endforeach
                  </select>
             </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
              <label for="id_transporte">Transporte</label>
              <select name="id_transporte" id="id_transporte" class="form-control selectpicker" data-Live-search="true">
                    @foreach($transportes as $transporte)
                     <option value="{{$transporte->id_transporte}}">{{$transporte->transporte}}</option>
                    @endforeach
                  </select>
             </div>
            </div>
          
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="tipodocumento">Tipo de comprobante</label>
              <select name="tipo_comprobante" class="form-control">
                   <option value="BOLETA">BOLETA</option>
                   <option value="FACTURA">FACTURA</option>
                   <option value="TICKET">TICKET</option>
                  </select>
            </div>
            </div>
              </div>
            <div class="row">
                  <div class="panel panel-primary">
                        <div class="panel-body">
                              <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                               <div class="form-group">
                                    <label>Producto</label>
                                    <select name="id_producto" id="pid_producto" class="form-control selectpicker" data-Live-search="true">
                                           @foreach($productos as $producto)
                                            <option value="{{$producto->id_producto}}_{{$producto->stock}}_{{$producto->preciounidad}}">{{$producto->producto}}</option>
                                           @endforeach

                                    </select>
                               </div>
                               </div>
                               <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                   <div class="form-group">
                                      <label for="cantidad">Cantidad</label>
                                      <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="cantidad">
                                  </div>
                               </div>
                               <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                   <div class="form-group">
                                      <label for="stock">Stock</label>
                                      <input type="number" disabled name="pstock" id="pstock" class="form-control" placeholder="Stock">
                                  </div>
                               </div>
                               <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                   <div class="form-group">
                                      <div class="form-group">
                                         <label for="costo">Costo</label>
                                        <input type="number" disabled name="pcosto" id="pcosto" class="form-control" placeholder="costo">
                                  </div>
                                  </div>
                               </div>
                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                   <div class="form-group">
                                      <div class="form-group">
                                         <label for="descuento">Descuento</label>
                                        <input type="number" name="pdescuento" id="pdescuento" class="form-control" placeholder="descuento">
                                  </div>
                                  </div>
                               </div>
                               <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                   <div class="form-group">
                                      <button type="button" id="bt_add" class="btn btn-primary">AGREGAR</button>
                                  </div>
                               </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                      <thead style="background-color:#A9D0F5">
                                         <th>opciones</th>
                                         <th>Producto</th>
                                         <th>Cantidad</th>
                                         <th>Costo</th>
                                         <th>descuento</th>
                                         <th>Subtotal</th>
                                      </thead>
                                      <tfoot>
                                          <th>TOTAL</th>
                                         <th></th>
                                         <th></th>
                                         <th></th>
                                         <th></th>
                                         <th><h4 id="total">S/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></input></th>
                                      </tfoot>
                                      <tbody>
                                        
                                      </tbody>
                                    </table>
                               </div>
                        </div>
                  </div>
                   
                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
                       <div class="form-group">
                          I <input type="hidden" value="{{csrf_token() }}" name="_token">
                          <button class="btn btn-primary" type="submit">Guardar</button>
                          <button class="btn btn-danger" type="reset">Cancelar</button>
                      </div>
                  </div>
            </div>
           
            

      {!!Form::close()!!}   
            
    </div>
  </div>
  @push('scripts')
    <script>
         $(document).ready(function(){
            $('#bt_add').click(function(){
              agregar();
            });
         });
         var cont=0;
         subtotal=[];
         total=0;

         $("#guardar").hide();
         $("#pid_producto").change(mostrarValores);

         function mostrarValores(){
          datosProducto=document.getElementById('pid_producto').value.split('_');
          $("#pcosto").val(datosProducto[2]);
          $("#pstock").val(datosProducto[1]);
         }

         function agregar()
         {
          datosProducto=document.getElementById('pid_producto').value.split('_');

           id_producto=datosProducto[0];
           producto=$("#pid_producto option:selected").text();
           pcantidad=$("#pcantidad").val();
           pdescuento=$("#pdescuento").val();
           pcosto=$("#pcosto").val();
           pstock=$("#pstock").val();
           
                
                if (id_producto!="" && pcantidad!="" && pcantidad>0 && pdescuento!="" && pcosto!="") {
                   
                    if (Number(pstock)>=Number(pcantidad)) {
                      var desc=pcantidad*pcosto;
                      if (desc>pdescuento) {
                      subtotal[cont]=(pcantidad*pcosto-pdescuento);
                      total= total+subtotal[cont];
                      var fila='<tr class="selected" id="file'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">x</button></td><td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td><td><input type="number" name="pcantidad[]" value="'+pcantidad+'"></td><td><input type="number" name="pcosto[]" value="'+pcosto+'"></td><td><input type="number" name="pdescuento[]" value="'+pdescuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
                      cont++;
                      limpiar();
                      $("#total").html("S/. " + total);
                      $("#total_venta").val(total);
                      evaluar();
                      $("#detalles").append(fila);
                    }else{
                      alert("el descuento supera a la ganancia");
                    }
                   }else{
                     alert("stock Insuficiente");
                    }
                  
                }else{
                  alert("error al ingresar el detalle del ingreso revise los datos");
                }

         }
      
      function limpiar(){
        $("#pcantidad").val("");
        $("#pdescuento").val("");
        $("#pcosto").val("");
      }

      function evaluar(){
        if (total>0) {
          $('#guardar').show();
        }else{
           $('#guardar').hide();
        }
      }

      function eliminar(index){
        total=total-subtotal[index];
        $("#total").html("S/. " + total);
        $("#total_venta").val(total);
        $("#fila" + index).remove();
        evaluar();
      }
    </script>
  @endpush
@endsection