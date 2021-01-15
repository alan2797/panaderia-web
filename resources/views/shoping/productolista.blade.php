
@extends('layouts.app')
@section('content')
<div class="container">
     <div class="row">

         <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
         
                    
               @foreach ($productos as $pro)
               
                    <td>
                        
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                              
                        <button type="button" id="bt_add" class="btn btn-primary">AGREGAR AL CARRITO</button>
                        <img src="{{asset('imagenes/productos/'.$pro->imagen)}}" alt="{{$pro->nombre}}" height="400px" width="300px" class="img-thumbnail">
                        <label>{{$pro->nombre}}</label>
                        <label>{{$pro->preciounidad}}</label>
                        
                         </img>
        
                     </div>
                        
                    </td>
                   
                
                @endforeach
               
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                  <h1>HOLA YULIANA</h1>
                </div>
        </div>
          
        {{$productos->render()}}
    </div>

@endsection
