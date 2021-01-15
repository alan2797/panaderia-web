<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductoFormRequest;
use DB;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if ($request) {
              $query= trim($request->get('searchText'));
              $productos=DB::table('producto')->where('nombre','LIKE','%'.$query.'%')
              ->where('estado','=','disponoble')
              ->orderBy('id_producto','desc')
              ->paginate('7');
              return view('almacen.producto.index',["productos"=>$productos,"searchText"=>$query]);
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
        return view("almacen.producto.create");
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
        $producto= new Producto;
     	$producto->nombre=$request->get('nombre');
        $producto->stock=$request->get('stock');
        $producto->preciounidad=$request->get('preciounidad');
        $producto->estado='disponoble';
         if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
            $producto->imagen=$file->getClientOriginalName();//aqui se devuelve el nombre de la imagen
        }
        $producto->save();

        return Redirect::to('almacen/producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return view("almacen.producto.show",["producto"=>Producto::findOrFail($id)]);

    }
    public function edit($id){
        return view("almacen.producto.edit",["producto"=>Producto::findOrFail($id)]);

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
        $producto=Producto::findOrFail($id);
        $producto->nombre=$request->get('nombre');
        $producto->stock=$request->get('stock');
        $producto->preciounidad=$request->get('preciounidad');
          if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
            $producto->imagen=$file->getClientOriginalName();//aqui se devuelve el nombre de la imagen
        }

        $producto->update();
        return Redirect::to('almacen/producto');
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
        $producto=Producto::findOrFail($id);
        $producto->estado='agotado';
        $producto->update();
         return Redirect::to('almacen/producto');
    }
}
