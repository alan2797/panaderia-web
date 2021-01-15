@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3>Nueva Produccion</h3>
      @if (count($errors)>0)
      <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
        </ul>
      </div>
      @endif

      {!!Form::open(array('url'=>'produccion/producto','method'=>'POST',
        'autocomplete'=>'off','onsubmit'=>'return validar(this)','name'=>'formV'))!!}
            {{Form::token()}}
            <div class="row">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
             <div class="form-group">
              <label for="nombre">Ecargado</label>
              <select name='id_persona' id="id_persona" class="form-control selectpicker" data-Live-search="true">
                    @foreach($personas as $persona)
                     <option value="{{$persona->id_persona}}">{{$persona->nombre}}</option>
                    @endforeach

                  </select>
             </div>
            </div>
             <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
             <div class="form-group">
              <label for="nombre">Producto</label>
              <select name='id_producto' id="id_producto" class="form-control selectpicker" data-Live-search="true">
                    @foreach($productos as $producto)
                     <option value="{{$producto->id_producto}}">{{$producto->producto}}</option>
                    @endforeach

                  </select>
             </div>
            </div>
          
           
              </div>
              <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                   <div class="form-group">
                                      <div class="form-group">
                                         <label for="fecha">Cantidad a Producir</label>
                                        <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="cantidad">
                                        <label id="lblcantidad" style="display:none;color:red;">Cantidad a Producir requirido</label>
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
                                      <label for="cantidad">Cantidad en KG a usar</label>
                                      <input type="number" name="pcantidadkg" id="pcantidadkg" class="form-control" placeholder="cantidad a usar">
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
                                         <th>Cantidad en KG.</th>
                                      
                                      </thead>
                                      <tfoot>
                                         
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
               {!!Form::close()!!} 
            </div>    

      </div>
  </div>
  <script>
  function validar(e){
        console.log("validando")
                //expresionEmail = /\w+@\w+\.+[a-z]/;  
                //expresionTelefono = /\/;  
        var cantidad = document.getElementById('cantidad');
        var lblcantidad = document.getElementById('lblcantidad');
        lblcantidad.setAttribute("style", "display: none;");
         
        var bool = true;
		  if (!/^([0-9])*$/.test(cantidad.value) || cantidad.value.length== 0) {
        lblcantidad.setAttribute("style", "display: initial;color:red;");
              //alert('Rellena el campo nomnbre');
              
              if(bool){
                  document.formV.cantidad.focus() 
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
           pcantidadkg=$("#pcantidadkg").val();
          
                
                if (id_insumo!="" && pcantidadkg!="" && pcantidadkg>0) {

                  //subtotal[cont]=(pcantidad*pprecio_compra);
                  //total= total+subtotal[cont];
                  var fila='<tr class="selected" id="file'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">x</button></td><td><input type="hidden" name="id_insumo[]" value="'+id_insumo+'">'+insumo+'</td><td><input type="number" name="pcantidadkg[]" value="'+pcantidadkg+'"></td></tr>';
                  cont++;
                  limpiar(); 
                  evaluar();
                  $("#detalles").append(fila);
                }else{
                  alert("error al ingresar el detalle del la produccion revise los datos");
                }

         }
      
      function limpiar(){
        $("#pcantidadkg").val("");
        
      }

      function evaluar(){
          $('#guardar').show();
      }

      function eliminar(index){
        $("#fila" + index).remove();
        evaluar();
      }
    </script>
  @endpush
@endsection