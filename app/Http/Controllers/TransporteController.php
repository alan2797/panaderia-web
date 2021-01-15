<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Transporte;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TransporteFormRequest;
use DB;
class TransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if ($request) {
        	$query=trim($request->get('searchText'));
        	$transportes=DB::table('transporte')->where('placa','LIKE','%'.$query.'%')
        	->where('estado','=','activo')
        	->orderBy('id_transporte','desc')
        	->paginate('7');
            return view('almacen.transporte.index',["transportes"=>$transportes,"searchText"=>$query]);
        }

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("almacen.transporte.create");
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
        $transporte=new Transporte;
        $transporte->placa=$request->get('placa');
        $transporte->modelo=$request->get('modelo');
        $transporte->color=$request->get('color');
        $transporte->descripcion=$request->get('descripcion');
        $transporte->estado='activo';
      
        $transporte->save();

        return Redirect::to('almacen/transporte');
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
        return view("almacen.transporte.show",["transporte"=>Transporte::findOrFail($id)]);
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
        return view("almacen.transporte.edit",["transporte"=>Transporte::findOrFail($id)]);
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
        $transporte=Transporte::findOrFail($id);
        $transporte->placa=$request->get('placa');
        $transporte->modelo=$request->get('modelo');
        $transporte->color=$request->get('color');
        $transporte->descripcion=$request->get('descripcion');
        $transporte->update();
        return Redirect::to('almacen/transporte');
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
        $transporte=Transporte::findOrFail($id);
        $transporte->estado='inactivo';
        $transporte->update();
        return Redirect::to('almacen/transporte');
    }
}
