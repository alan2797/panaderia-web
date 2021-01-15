<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Producto;
use App\DetalleVenta;
use App\Venta;
use App\Persona;
use App\Distribucion;
use App\Transporte;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Http\Requests\VentaFormRequest;
use App\Http\Requests\EstadoFormRequest;
use DB;

class ConfirmarVentaController extends Controller
{
       public function __construct()
        {
   
         }
      public function index(Request $request)
        {
       if ($request)
        {
            $query=trim($request->get('searchText'));
            $ventas=DB::table('venta as v')
            ->join('persona as p','v.id_persona','=','p.id_persona')
            ->join('detalleventa as dv','v.id_venta','=','dv.id_venta')
            ->join('distribucion as dis','v.id_distribucion','=','dis.id_distribucion')
            ->join('transporte as trans','v.id_transporte','=','trans.id_transporte')
            ->select('v.id_venta','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','dis.tipo_envio','trans.placa','v.impuesto','v.estado','v.total_venta')
            ->where('v.num_comprobante','LIKE','%'.$query.'%')
            ->where('v.estado','=','Pendiente')
    
            ->orderBy('id_venta','desc')
            ->groupBy('v.id_venta','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','dis.tipo_envio','trans.placa','v.impuesto','v.estado')
            ->paginate(7);
            return view('atender.atendido.index',["ventas"=>$ventas,"searchText"=>$query]);
        }
    }

        public function show($id)
        {
        $venta=DB::table('venta as ven')
            ->join('persona as p','ven.id_persona','=','p.id_persona')
            ->join('detalleventa as dv','ven.id_venta','=','dv.id_venta')
             ->join('distribucion as dis','ven.id_distribucion','=','dis.id_distribucion')
             ->join('transporte as trans','ven.id_transporte','=','trans.id_transporte')
            ->select('ven.id_venta','ven.fecha_hora','p.nombre','ven.tipo_comprobante','ven.num_comprobante','ven.impuesto','dis.tipo_envio','trans.modelo','ven.estado','ven.total_venta')
            ->where('ven.id_venta','=',$id)
            ->first(); // firs saca el primero que cumpla

         $detalles=DB::table('detalleventa as dv')
         ->join('producto as pro','pro.id_producto','=','dv.id_producto')
         ->select('pro.nombre as producto','dv.cantidad','dv.descuento','dv.costo')
         ->where('dv.id_venta','=',$id)->get();
        return view("atender.atendido.show",["venta"=>$venta,"detalles"=>$detalles]);
    }
    public function edit($id)
    {
    	$venta=Venta::find($id);
        $transporte=DB::table('transporte')->select('id_transporte','modelo')->get();

    	return view('atender.atendido.edit',["venta"=>$venta,"transporte"=>$transporte]);
		
    }


    public function update(EstadoFormRequest $request,$id){

      	$venta=Venta::find($id);
        //$transporte=Transporte::find($id);
//      	$persona->update($request->all());
        //$factura=Facturaagua::find($id);
//      	$driver->update($request->all());

        $venta->estado=$request->get('estado');
        $venta->id_transporte=$request->get('transporte');
        $venta->update();


        return Redirect::to('atender/atendido'); 
    }
}
