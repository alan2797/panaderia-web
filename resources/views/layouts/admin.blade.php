<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PANADERIA</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    
  </head>
  <body class="hold-transition skin-blue sidebar-mini" >
    <div class="wrapper">

      <header class="main-header" style="background-color:{{trim(Auth::user()->color)}};">

        <!-- Logo -->
        <a href="index2.html" class="logo" style="background-color:{{trim(Auth::user()->color)}};">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>AD</b>V</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>panaderia</b>
          <b> @if (Auth::user()->tipouser != "admin") 
            'Administrador'
            @else  
            Auth::user()->tipouser 
            @endif</b>
          </span>
          
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation" 
              style="background-color:{{trim(Auth::user()->color)}};">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu" styles='font-size:35px'>
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <small class="bg-red" >Online</small>
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <p>
                    {{ Auth::user()->name }}
                    
                      <small></small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                  <div class="pull-left">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModa2">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Personalizar
                                </a>
                    </div>
                    <div class="pull-right">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" 
                                          method="POST" style="display: none;">
                                        @csrf
                                    </form>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
          <div class="modal fade" id="logoutModa2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Personalizacion</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{route('color')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Seleccione Color</label>
                            <select class="form-control" id="color" name="color">
                                <option value="#006b76">Azul</option>
                                <option value="#52575a">Gris</option>
                                <option value="#194d33">Verde</option>
                                <option value="#d32f2f">Rojo</option>
                                <option value="#333333">Negro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Tamaño de Fuente</label>
                            <input type="number" class="form-control" id="font_size" name="font_size">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-danger" value="Guardar">
                    </div>
                </form>

            </div>
        </div>
</div>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar"  
      style="background-color:{{trim(Auth::user()->color)}};font-size:{{trim(Auth::user()->tipoletra)}}px">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span >Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo url('almacen/insumo')?>"><i class="fa fa-circle-o"></i>Isumos</a></li>
                <li><a href="<?php echo url('almacen/producto')?>"><i class="fa fa-circle-o"></i>Productos</a></li>

              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo url('compras/ingreso')?>"><i class="fa fa-circle-o"></i>Ingreso producto</a></li>
                <li><a href="<?php echo url('produccion/producto')?>"><i class="fa fa-circle-o"></i>Produccion</a></li>
              
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo url('almacen/distribucion')?>"><i class="fa fa-circle-o"></i>Distribucion</a></li>
                <li><a href="<?php echo url('almacen/transporte')?>"><i class="fa fa-circle-o"></i>Transporte></li>
                  <li><a href="<?php echo url('ventas/venta')?>"><i class="fa fa-circle-o"></i>Venta></li>
              </ul>
            </li>
                       
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="<?php echo url('usuario/cliente')?>"><i class="fa fa-circle-o"></i>Cliente></li>
              @if ( trim(Auth::user()->tipouser) == 'admin')
                <li><a href="<?php echo url('usuario/proveedor')?>"><i class="fa fa-circle-o"></i>Usuarios</li>
              @endif
              </ul>
            @if ( trim(Auth::user()->tipouser) == 'admin')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Reportes Y Estaditicas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo url('reportesProduccion')?>">
                    <i class="fa fa-circle-o"></i>Reporte de Producciones</a>
                </li>
                <li><a href="<?php echo url('reportesCliente')?>">
                    <i class="fa fa-circle-o"></i>Reporte Cliente Frecuentes</a>
                </li>
                <li><a href="<?php echo url('reportesProducto')?>">
                    <i class="fa fa-circle-o"></i>Reporte Productos</a>
                </li>
                <li><a href="<?php echo url('estadisticaProducto')?>">
                    <i class="fa fa-circle-o"></i>Estadistica Productos</a>
                </li>
                <li><a href="<?php echo url('estadisticaCliente')?>">
                    <i class="fa fa-circle-o"></i>Estadistica Cliente</a>
                </li>
              </ul>
            </li>
            @endif
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema de panaderia</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2015-2020 <a href="www.incanatoit.com">IncanatoIT</a>.</strong> All rights reserved.
      </footer>

      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    

  </body>
</html>
