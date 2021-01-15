<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
use DB;
class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    
            ->orderBy('id_venta','desc')
            ->groupBy('v.id_venta','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','dis.tipo_envio','trans.placa','v.impuesto','v.estado')
            ->paginate(7);
            return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
        }
    }
    //nos quedamos aqui listo para hacer el create
    public function create()
    {
        $personas=DB::table('persona')->select('id_persona','nombre')->get();
        $productos= DB::table('producto as pro')
          ->select(DB::raw("CONCAT(pro.id_producto,' ',pro.nombre) as producto"),'pro.id_producto','pro.stock','pro.preciounidad') 
          ->where('pro.estado','=','disponoble')
          ->where('pro.stock','>','0')
          ->get();
          $distribuciones= DB::table('distribucion as distri')
          ->select(DB::raw("CONCAT(distri.id_distribucion,' ',distri.tipo_envio) as distribucion"),'distri.id_distribucion')
          ->where('distri.estado','=','disponible')
          ->get();
          $transportes= DB::table('transporte as trans')
          ->select(DB::raw("CONCAT(trans.placa,' ',trans.modelo) as transporte"),'trans.id_transporte')
          ->where('trans.estado','=','activo')
          ->get();
        return view("ventas.venta.create",["personas"=>$personas,"productos"=>$productos,"distribuciones"=>$distribuciones,"transportes"=>$transportes]);
    }
    public function store (Request $request)
    {
      try{
        DB::beginTransaction();
        $venta= new Venta; 
        $venta->id_persona=$request->get('id_persona');
        $venta->id_distribucion=$request->get('id_distribucion');
        $venta->id_transporte=$request->get('id_transporte');
        $venta->tipo_comprobante=$request->get('tipo_comprobante');
        $venta->num_comprobante=$request->get('num_comprobante');
        $venta->total_venta=$request->get('total_venta');

        $mytime= Carbon::now('America/lima');
        $venta->fecha_hora=$mytime->toDateTimeString();
        $venta->impuesto='13';
        $venta->estado='activo';
        $venta->save();
        // detalle_ingreso
        //todo estos son arreglos Array
         $id_producto= $request->get('id_producto');
         $cantidad= $request->get('pcantidad');
         $costo= $request->get('pcosto');
         $descuento= $request->get('pdescuento');
        

          $cont=0;

          while ($cont<count($id_producto)) {
               $detalle= new Detalleventa;
               $detalle->id_venta=$venta->id_venta;
               $detalle->id_producto=$id_producto[$cont];
               $detalle->cantidad=$cantidad[$cont];
               $detalle->costo=$costo[$cont];
               $detalle->descuento=$descuento[$cont];
               $detalle->save();
               $cont=$cont+1;
          }

          DB::commit();

      }catch(\exeption $e){

        DB::rollback();
      }
      return Redirect::to('ventas/venta');

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
        return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
    }
    public function edit($id)
    {
       // return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
   
    public function destroy($id)
    {
        $venta=Venta::findOrFail($id);
        $venta->estado='inactivo';
        $venta->update();
        return Redirect::to('ventas/venta');
    }
}
