<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Persona;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use DB;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if ($request) {
        	$query=trim($request->get('searchText'));
        	$clientes=DB::table('persona')->where('nombre','LIKE','%'.$query.'%')
        	->where('tipopersona','=','proveedor')
            ->orwhere('tipopersona','=','admin')
             ->orwhere('tipopersona','=','empleado')
        	->where('estado','=','activo')
        	->orderBy('id_persona','desc')
        	->paginate('7');
            return view('usuario.proveedor.index',["clientes"=>$clientes,"searchText"=>$query]);
        }

     }

     public function create(){

     	return view("usuario.proveedor.create");
     }

     public function store(Request $request){
        $cliente=new Persona;
        $cliente->nombre=$request->get('nombre');
        $cliente->tipopersona=$request->get('tipoempleado');
        $cliente->tipodocumento=$request->get('tipodocumento');
        $cliente->numero_documento=$request->get('numero_documento');
        $cliente->direccion=$request->get('direccion');
        $cliente->telefono=$request->get('telefono');
        $cliente->email=$request->get('email');
        $cliente->estado='activo';
      
        $cliente->save();

        User::create([
            'name' => $request->get('nombre'),
            'email' =>  $request->get('email'),
            'password' => Hash::make($request->get('numero_documento')),
            'tipouser' => $request->get('tipoempleado'),
            'color' => 'blue',
            'tipoletra' => 'normal',
        ]);
        return Redirect::to('usuario/proveedor');

     }
     public function show($id)
    {
        return view("usuario.proveedor.show",["cliente"=>Persona::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("usuario.proveedor.edit",["cliente"=>Persona::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $cliente=Persona::findOrFail($id);
       $cliente->nombre=$request->get('nombre');
        $cliente->tipodocumento=$request->get('tipodocumento');
        $cliente->numero_documento=$request->get('numero_documento');
        $cliente->direccion=$request->get('direccion');
        $cliente->telefono=$request->get('telefono');
        $cliente->email=$request->get('email');
        $cliente->update();
        return Redirect::to('usuario/proveedor');
    }
    public function destroy($id)
    {
        $cliente=Persona::findOrFail($id);
        $cliente->estado='inactivo';
        $cliente->update();
        return Redirect::to('usuario/proveedor');
    }
}
