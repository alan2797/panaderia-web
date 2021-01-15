@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3>Nuevo Ingreso</h3>
      @if (count($errors)>0)
      <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
        </ul>
      </div>
      @endif

      {!!Form::open(array('url'=>'compras/ingreso','method'=>'POST',
        'autocomplete'=>'off','onsubmit'=>'return validar(this)','name'=>'formV'))!!}
            {{Form::token()}}
            <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
             <div class="form-group">
              <label for="nombre">Proveedor</label>
              <select name='id_persona' id="id_persona" class="form-control selectpicker" data-Live-search="true">
                    @foreach($personas as $persona)
                     <option value="{{$persona->id_persona}}">{{$persona->nombre}}</option>
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
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="Numero comprobante">Numero de comprobante</label>
              <input type="text" name="numero_comprobante" id="numero_comprobante" 
              value="{{old('numero_comprobante')}}" class="form-control" placeholder="numero...">
              <label id="lblnumero_comprobante" style="display:none;color:red;">Numero De Comprobante requirido</label>
            </div>
             </div>
              </div>
            <div class="row">
                  <div class="panel panel-primary">
                        <div class="panel-body">
                              <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                               <div class="form-group">
                                    <label>Insumo</label>
                                    <select name='id_insumo' id="pid_insumo" class="form-control selectpicker" data-Live-search="true">
                                           @foreach($insumos as $insumo)
                                            <option value="{{$insumo->id_insumo}}">{{$insumo->insumo}}</option>
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
                                      <div class="form-group">
                                         <label for="precio_compra">Precio de compra</label>
                                        <input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="precio de compra">
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
                                         <th>Insumo</th>
                                         <th>Cantidad</th>
                                         <th>precio de compra</th>
                                         <th>Subtotal</th>
                                      </thead>
                                      <tfoot>
                                          <th>TOTAL</th>
                                         <th></th>
                                         <th></th>
                                         <th></th>
                                         <th><h4 id="total">S/. 0.00</h4></th>
                                      </tfoot>
                                      <tbody>
                                        
                                      </tbody>
                                    </table>
                               </div>
                        </div>
                  </div>
                   
                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
                       <div class="form-group">
                           <input type="hidden" value="{{csrf_token() }}" name="_token">
                          <button class="btn btn-primary" type="submit">Guardar</button>
                          <button class="btn btn-danger" type="reset">Cancelar</button>
                      </div>
                  </div>
            </div>
           
            

      {!!Form::close()!!}   
            
    </div>
  </div>
  <script>
  function validar(e){
        console.log("validando")
                //expresionEmail = /\w+@\w+\.+[a-z]/;  
                //expresionTelefono = /\/;  
        var numero_comprobante = document.getElementById('numero_comprobante');
        var lblnumero_comprobante = document.getElementById('lblnumero_comprobante');
        lblnumero_comprobante.setAttribute("style", "display: none;");
         
        var bool = true;
		  if (!/^([0-9])*$/.test(numero_comprobante.value) || numero_comprobante.value.length== 0) {
        lblnumero_comprobante.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.numero_comprobante.focus() 
                  bool = false;
              }
		  }
          return bool;
      }
   </script>  
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

         function agregar(){
           id_insumo=$("#pid_insumo").val();
           insumo=$("#pid_insumo option:selected").text();
           pcantidad=$("#pcantidad").val();
           pprecio_compra=$("#pprecio_compra").val();
                
                if (id_insumo!="" && pcantidad!="" && pcantidad>0 && pprecio_compra!="") {

                  subtotal[cont]=(pcantidad*pprecio_compra);
                  total= total+subtotal[cont];
                  var fila='<tr class="selected" id="file'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">x</button></td><td><input type="hidden" name="id_insumo[]" value="'+id_insumo+'">'+insumo+'</td><td><input type="number" name="pcantidad[]" value="'+pcantidad+'"></td><td><input type="number" name="pprecio_compra[]" value="'+pprecio_compra+'"></td><td>'+subtotal[cont]+'</td></tr>';
                  cont++;
                  limpiar();
                  $("#total").html("S/. " + total);
                  evaluar();
                  $("#detalles").append(fila);
                }else{
                  alert("error al ingresar el detalle del ingreso revise los datos");
                }

         }
      
      function limpiar(){
        $("#pcantidad").val("");
        $("#pprecio_compra").val("");
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
        $("#fila" + index).remove();
        evaluar();
      }
    </script>
  @endpush
@endsection