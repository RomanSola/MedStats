<?php

namespace App\Http\Controllers;

use App\Models\UsuarioPerfil;
use Illuminate\Http\Request;

class UsuarioPerfilController extends Controller
{
    //Muestra todos los perfiles
    public function index() //Pagina inicial
    {
        $perfiles = UsuarioPerfil::all(); //Hace un select all a la tabla
        //dd($perfiles);
        return view('UsuarioPerfil.index', compact('perfiles')); //Llama a la vista y le pasa los datos
    }

    public function create()
    {
        return view('UsuarioPerfil.create');
    }

    public function store(Request $request)
    {
        $request->validate([ //Si el titulo esta vacio no hace nada 
            'perfil' => 'required',
        ]);

        $perfil = new UsuarioPerfil();
        $perfil->perfil = $request->input('perfil'); //Datos del POST se obtiene en request
        $perfil->save(); //Guarda en la BD, si existe lo actualiza, sino crea
        
        return redirect()->route('UsuarioPerfil.index');
    }

    public function edit(UsuarioPerfil $perfil)
    {
        //dd($categorias);
        return view('UsuarioPerfil.edit', compact('perfil'));
    }

    public function update(Request $request, UsuarioPerfil $perfil)
    {
        if ($request->input('perfil') != null) {
            $perfil->perfil = $request->input('perfil');
        }
        $perfil->save();
        return redirect()->route('UsuarioPerfil.index');
    }

    public function destroy(UsuarioPerfil $perfil)
    {
        $perfil->delete();
        return redirect()->route('UsuarioPerfil.index');
    }
}
