<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
class ReporteClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes=DB::table('persona as per')
        ->join('venta as v','per.id_persona','=','v.id_persona')
        ->select('per.id_persona','per.nombre','per.numero_documento','per.direccion','per.telefono','per.email',
                    DB::raw('SUM(v.total_venta) as total_venta'))
        ->where('per.tipopersona', '=', 'cliente')
        ->orderBy('total_venta','desc')
        ->groupBy('per.id_persona')
        ->paginate(10);
        return view('Reportes.ReporteCliente',compact('clientes'));
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
        $fechaini = $request->fechaini;
        $fechafin = $request->fechafin;
        if($fechaini == '' && $fechafin ==''){
            $clientes=DB::table('persona as per')
            ->join('venta as v','per.id_persona','=','v.id_persona')
            ->select('per.id_persona','per.nombre','per.numero_documento','per.direccion','per.telefono','per.email',
                        DB::raw('SUM(v.total_venta) as total_venta'))
            ->where('per.tipopersona', '=', 'cliente')
            ->orderBy('total_venta','desc')
            ->groupBy('per.id_persona')
            ->paginate(7);
            $date = date('Y-m-d');
            $vistaurl="Reportes.invoice_1";
            $view = \View::make($vistaurl,compact('clientes','date'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('reporte_clientes_frecuentes.pdf'); 
        }
        /*if($fechaini != '' && $fechafin!= ''){
            $clientes =  Cliente::where('created_at','>',$fechaini)
                                ->where('created_at','<',$fechafin)
                                ->get();
           /* $clientes = DB::table('clientes')
           / ->whereBetween('created_at',[$fechaini,$fechafin])
            ->get();*/
            /*$fecha1 = new Carbon('America/La_paz');
            $date = $fecha1->format('d-m-Y');
            $vistaurl="admin/Reportes.invoice_1";
            $view = \View::make($vistaurl,compact('clientes','date'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('reporte_clientes');
        }*/
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

        $date = date('Y-m-d');
        $vistaurl="Reportes.factura";
        $view = \View::make($vistaurl,compact('venta','date','detalles'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('factura.pdf'); 
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
