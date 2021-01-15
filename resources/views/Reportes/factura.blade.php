<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
    <center><h2>{{$venta->tipo_comprobante}} De  Venta</h2></center>
<div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
             <div class="form-group">
                <label for="nombre" style="font-weight:bold">Cliente
             :        <label>{{$venta->nombre}}</label></label>
                <p></p>
             </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="tipodocumento" style="font-weight:bold">Tipo de comprobante   :     
            <label>{{$venta->tipo_comprobante}}</label></label>
            	     <p></p>
            </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="Numero comprobante" style="font-weight:bold" >Numero de comprobante   :    
            <label>{{$venta->num_comprobante}}</label></label>
            	 <p></p>
</div>
    <table id="customers">
        <thead>
            <tr>
            <th>producto</th>
            <th>Cantidad</th>
            <th>precio de Venta</th>
            <th>Descuento</th>
            <th>Subtotal</th>
</tr>
        </thead>
        
        <tbody>
            @foreach($detalles as $det)
            <tr>
                <td>{{$det->producto}}</td>
                <td>{{$det->cantidad}}</td>
                <td>{{$det->costo}}</td>
                <td>{{$det->descuento}}</td>
                <td>{{$det->cantidad*$det->costo-$det->descuento}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><h4 >{{$venta->total_venta}}</h4></td>
</tr>
        </tfoot>
    </table>

</body>
</html>
