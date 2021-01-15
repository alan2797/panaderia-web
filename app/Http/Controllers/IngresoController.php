<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Insumo;
use App\detelle_ingreso;
use App\Ingreso;
use App\Persona;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Http\Requests\IngresoFormRequest;
use DB;
class IngresoController extends Controller
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
            $ingresos=DB::table('ingreso as i')
            ->join('persona as p','i.id_persona','=','p.id_persona')
            ->join('detalle_ingreso as di','i.id_ingreso','=','di.id_ingreso')
            ->select('i.id_ingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.numero_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('i.numero_comprobante','LIKE','%'.$query.'%')
    
            ->orderBy('id_ingreso','desc')
            ->groupBy('i.id_ingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.numero_comprobante','i.impuesto','i.estado')
            ->paginate(7);
            return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }
    public function create()
    {
        $personas=DB::table('persona')->where('tipopersona','=','proveedor')->get();
        $insumos= DB::table('insumo as art')
          ->select(DB::raw("CONCAT(art.id_insumo,' ',art.nombre) as insumo"),'art.id_insumo')
          ->where('art.estado','=','disponible')
          ->get();
        return view("compras.ingreso.create",["personas"=>$personas,"insumos"=>$insumos]);
    }
    public function store (Request $request)
    {
      try{
        DB::beginTransaction();
        $ingreso= new Ingreso; 
        $ingreso->id_persona=$request->get('id_persona');
        $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
        $ingreso->numero_comprobante=$request->get('numero_comprobante');

        $mytime= Carbon::now('America/Lima');
        $ingreso->fecha_hora=$mytime->toDateTimeString();
        $ingreso->impuesto='13';
        $ingreso->estado='activo';
        $ingreso->save();
        // detalle_ingreso
        //todo estos son arreglos Array
         $id_insumo= $request->get('id_insumo');
         $cantidad= $request->get('pcantidad');
         $precio_compra= $request->get('pprecio_compra');
        

          $cont=0;

          while ($cont<count($id_insumo)) {
               $detalle= new detelle_ingreso;
               $detalle->id_ingreso=$ingreso->id_ingreso;
               $detalle->id_insumo=$id_insumo[$cont];
               $detalle->cantidad=$cantidad[$cont];
               $detalle->precio_compra=$precio_compra[$cont];
               $detalle->save();
               $cont=$cont+1;
          }

          DB::commit();

      }catch(\exeption $e){

        DB::rollback();
      }
      return Redirect::to('compras/ingreso');

    }

    public function show($id)
    {
        $ingreso=DB::table('ingreso as i')
            ->join('persona as p','i.id_persona','=','p.id_persona')
            ->join('detalle_ingreso as di','i.id_ingreso','=','di.id_ingreso')
            ->select('i.id_ingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.numero_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('i.id_ingreso','=',$id)
            ->first(); // firs saca el primero que cumpla

         $detalles=DB::table('detalle_ingreso as d')
         ->join('insumo as in','in.id_insumo','=','d.id_insumo')
         ->select('in.nombre as insumo','d.cantidad','d.precio_compra')
         ->where('d.id_ingreso','=',$id)->get();
        return view("compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }
    public function edit($id)
    {
       // return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
   
    public function destroy($id)
    {
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->estado='inactivo';
        $ingreso->update();
        return Redirect::to('compras/ingreso');
    }
}
