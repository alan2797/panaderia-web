<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Insumo;
use App\Persona;
use App\Producto;
use App\DetalleProduccion;
use App\Produccion;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Http\Requests\DetalleproductoFormRequest;
use DB;
class DetalleproductoController extends Controller
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
          $producciones=DB::table('produccion as pro')
          ->join('persona as p','pro.id_persona','=','p.id_persona')
          ->join('producto as product','pro.id_producto','=','product.id_producto')

          ->select('pro.id_produccion','pro.fecha_produccion','p.nombre as empleado',
                    'pro.cantidad','product.nombre as producto')
          ->where('product.nombre','LIKE','%'.$query.'%')
  
          ->orderBy('id_produccion','desc')
          ->paginate('7');
          return view('produccion.producto.index',
                      ["producciones"=>$producciones,"searchText"=>$query]);
        }
    }
    public function create()
    {
       $personas=DB::table('persona')->where('tipopersona','=','empleado')->get(); 
        $productos= DB::table('producto as product')
          ->select(DB::raw("CONCAT(product.id_producto,' ',product.nombre) as producto"),'product.id_producto','product.nombre')
          ->where('product.estado','=','disponoble')
          ->get();
            $insumos=DB::table('insumo as art')
          ->select(DB::raw("CONCAT(art.id_insumo,' ',art.nombre) as insumo"),'art.id_insumo')
          ->where('art.estado','=','disponible')
          ->get();
        return view("produccion.producto.create",["insumos"=>$insumos,"personas"=>$personas,"productos"=>$productos]);
    }
    public function store (Request $request)
    {
     // dd($request->get('pcantidadkg'));
      try{
        DB::beginTransaction();
        $produccion= new Produccion; 
        $produccion->id_persona=$request->get('id_persona');
        $produccion->id_producto=$request->get('id_producto');
    

        $mytime= Carbon::now('America/Lima');
        $produccion->fecha_produccion=$mytime->toDateTimeString();
        $produccion->cantidad=$request->get('cantidad');
       
        $produccion->save();
        // detalle_ingreso
        //todo estos son arreglos Array
         $id_insumo= $request->get('id_insumo');
         $cantidadkg= $request->get('pcantidadkg');
        

          $cont=0;

          while ($cont<count($id_insumo)) {
               $detalle= new DetalleProduccion;
               $detalle->id_produccion=$produccion->id_produccion;
                //$detalle->id_ingreso=$ingreso->id_ingreso;
               $detalle->id_insumo=$id_insumo[$cont];
               $detalle->cantidadkg=$cantidadkg[$cont];
               $detalle->save();
               $cont=$cont+1;
          }

          DB::commit();

      }catch(\exeption $e){

        DB::rollback();
      }
      return Redirect::to('produccion/producto');

    }

    public function show($id)
    {
        $producciones=DB::table('produccion as pro')
            ->join('persona as p','pro.id_persona','=','p.id_persona')
            ->join('producto as produ','pro.id_producto','=','produ.id_producto')
            ->join('detalleproducto as dpro','pro.id_produccion','=','dpro.id_produccion')
            ->select('pro.id_produccion','pro.fecha_produccion','p.nombre as empleado',
                      'pro.cantidad','produ.nombre as producto')
            ->where('pro.id_produccion','=',$id)
            ->first();
            
         $detalles=DB::table('detalleproducto as dpro')
         ->join('insumo as in','dpro.id_insumo','=','in.id_insumo')
         ->select('in.nombre as insumo','dpro.cantidadkg')
         ->where('dpro.id_produccion','=',$id)
         ->get();
         //dd($producciones);
        // dd($detalles);
        
        return view('produccion.producto.show',["producciones"=>$producciones,"detalles"=>$detalles]);
    }
    public function edit($id)
    {
       // return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
   
    public function destroy($id)
    {
       // $produccion=detalleproducto::findOrFail($id);
        //$produccion->estado='inactivo'; // un detalle de produccion no puede eliminarce
        //$produccion->update();
        //return Redirect::to('produccion/producto');
    }
}
