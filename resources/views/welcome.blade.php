@extends('layouts.app')
@section('content')
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="fluid">
  <h2> <a href="shoping/productolista/create"><button class="btn btn-success">COMPRA TU PRODUCTO AHORA</button></a></h2>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->

    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" >
      <div class="item active">
        <img src="{{asset('imagenes/productos/slider1.jpg')}}" alt="Los Angeles" style="width:100%; height: 60%;">
      </div>

      <div class="item">
        <img src="{{asset('imagenes/productos/slider2.jpg')}}" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="{{asset('imagenes/productos/slider3.jpg')}}" alt="New york" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
    @yield('content')

    <!-- JavaScripts -->
    <script src="{{ asset('js/app.js') }}"></script></script>
    {{--<script src="{{ elixir('js/app.js') }}"></script> --}}
     
    <script >

  // do something…

    </script>
    

  </body>
</div>
@endsection

