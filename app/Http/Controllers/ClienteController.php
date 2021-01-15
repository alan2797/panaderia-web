<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Persona;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use DB;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
class ClienteController extends Controller
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
        	->where('tipopersona','=','cliente')
        	->where('estado','=','activo')
        	->orderBy('id_persona','desc')
        	->paginate('7');
            return view('usuario.cliente.index',["clientes"=>$clientes,"searchText"=>$query]);
        }

     }

     public function create(){

     	return view("usuario.cliente.create");
     }

     public function store(Request $request){
        $cliente=new Persona;
        $cliente->nombre=$request->get('nombre');
        $cliente->tipopersona='cliente';
        $cliente->tipodocumento=$request->get('tipodocumento');
        $cliente->numero_documento=$request->get('numero_documento');
        $cliente->direccion=$request->get('direccion');
        $cliente->telefono=$request->get('telefono');
        $cliente->email=$request->get('email');
        $cliente->estado='activo';
      
        $cliente->save();

        /*User::create([
            'name' => $request->get('nombre'),
            'email' =>  $request->get('email'),
            'password' => Hash::make($request->get('numero_documento')),
            'tipouser' => 'cliente',
            'color' => 'blue',
            'tipoletra' => 'normal',
        ]);*/
        return Redirect::to('usuario/cliente');

     }
     public function show($id)
    {
        return view("usuario.cliente.show",["cliente"=>Persona::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("usuario.cliente.edit",["cliente"=>Persona::findOrFail($id)]);
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
        return Redirect::to('usuario/cliente');
    }
    public function destroy($id)
    {
        $cliente=Persona::findOrFail($id);
        $cliente->estado='inactivo';
        $cliente->update();
        return Redirect::to('usuario/cliente');
    }
}
