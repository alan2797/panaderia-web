<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
class ReporteProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $producciones=DB::table('produccion as pro')
        ->join('persona as p','pro.id_persona','=','p.id_persona')
        ->join('producto as product','pro.id_producto','=','product.id_producto')

        ->select('pro.id_produccion','pro.fecha_produccion','p.nombre as empleado',
                  'pro.cantidad','product.nombre as producto')

        ->orderBy('pro.fecha_produccion','desc')
        ->paginate('10');
        return view('Reportes.ReporteProduccion',compact('producciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

         $date = date('Y-m-d');
            $vistaurl="Reportes.invoice_3";
            $view = \View::make($vistaurl,compact('producciones','detalles','date'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
        return $pdf->stream('reporte_produccion.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
