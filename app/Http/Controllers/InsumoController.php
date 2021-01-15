<?php

namespace App\Http\Controllers;
use App\Insumo;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\InsumoFormRequest;
class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request) {
        	$query=trim($request->get('searchText'));
        	$insumos=DB::table('insumo')->where('nombre','LIKE','%'.$query.'%')
        	->where('estado','=','disponible')
        	->orderBy('id_insumo','desc')
        	->paginate('7');
            return view('almacen.insumo.index',["insumos"=>$insumos,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("almacen.insumo.create");
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
        $insumo=new Insumo;
        $insumo->nombre=$request->get('nombre');
        $insumo->descripcion=$request->get('descripcion');
        $insumo->stockkg=$request->get('Stockkg');
        $insumo->estado='disponible';
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path('imagenes/insumos'),$file->getClientOriginalName());
            $insumo->imagen=$file->getClientOriginalName();//aqui se devuelve el nombre de la imagen
        }
        $insumo->save();

        return Redirect::to('almacen/insumo');
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
        return view("almacen.insumo.show",["insumo"=>Insumo::findOrFail($id)]);
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
        return view("almacen.insumo.edit",["insumo"=>Insumo::findOrFail($id)]);
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
        $insumo=Insumo::findOrFail($id);
        $insumo->nombre=$request->get('nombre');
         $insumo->descripcion=$request->get('descripcion');
         $insumo->stockkg=$request->get('Stockkg');
         if(Input::hasFile('imagen')){
             $file = Input::file('imagen');
             $file->move(public_path().'/imagenes/insumos/',$file->getClientOriginalName());
             $insumo->imagen=$file->getClientOriginalName();//aqui se devuelve el nombre de la imagen
         }
         $insumo->update();
         return Redirect::to('almacen/insumo');
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
        $insumo=Insumo::findOrFail($id);
        $insumo->estado='no disponible';
        $insumo->update();
        return Redirect::to('almacen/insumo');
    }
}
