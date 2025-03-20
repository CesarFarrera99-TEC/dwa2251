<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PuertaController extends Controller
{
    public function registrar(Request $request){
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios',
            'clave' => 'required|string|min:6|confirmed', // confirmed sirve para confirmar que la clave fue puesta 2 veces seguidas en el formulario
        ]);

        // Crear el usuario en la base de datos
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'nombre_usuario' => $request->nombre_usuario,
            'clave' => Hash::make($request->clave), // Encriptar la clave
        ]);

        // Autenticar al usuario después de registrarlo
        Auth::login($usuario);

        // Redireccionar a la vista que desees después del registro
        return redirect()->route('dashboard')->with('success', 'Registro exitoso.');
    }

    public function showRegister(){
        return view('puerta.register');
    }

    public function login(){
        return view ("puerta.login");

    }
    public function validar(Request $request){
      //echo  Usuario::all(); // Obtiene todos los usuarios


        //tengo que checar que lo que viene en peticion sea correcto
//        echo "checar si  $request->nombre_usuario tiene $request->clave ";
        $encontrado = Usuario::where('nombre_usuario', $request->nombre_usuario)->first();
        if(is_null($encontrado)){
            echo "ni te conozco";
        }else{
          if( Hash::check($request->clave , $encontrado->clave) ){
            Auth::login($encontrado);
            return redirect()->route('dashboard')->with('success', 'Registro exitoso.');
            
          }else{
            echo "no te sabes la clave";
          }
        }
    }
}
