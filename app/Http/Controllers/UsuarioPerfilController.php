<?php

namespace App\Http\Controllers;

use App\Models\UsuarioPerfil;
use App\Models\User; // Agregar este import
use Illuminate\Http\Request;

class UsuarioPerfilController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo perfil
     */
    public function create()
    {
        return view('UsuarioPerfil.create');
    }

    /**
     * Almacena un nuevo perfil en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'perfil' => 'required',
        ]);

        $perfil = new UsuarioPerfil();
        $perfil->perfil = $request->input('perfil');
        //admin
        if ($request->input('admin') != null) {
            $perfil->admin = true;
        } else {
            $perfil->admin = false;
        }
        //insumos
        if ($request->input('insumos') != null) {
            $perfil->insumos = true;
        } else {
            $perfil->insumos = false;
        }
        //estadisticas
        if ($request->input('estadisticas') != null) {
            $perfil->estadisticas = true;
        } else {
            $perfil->estadisticas = false;
        }
        //pacientes
        if ($request->input('pacientes') != null) {
            $perfil->pacientes = true;
        } else {
            $perfil->pacientes = false;
        }
        //camas
        if ($request->input('camas') != null) {
            $perfil->camas = true;
        } else {
            $perfil->camas = false;
        }
        //cirugias
        if ($request->input('cirugias') != null) {
            $perfil->cirugias = true;
        } else {
            $perfil->cirugias = false;
        }

        $perfil->save();

        return redirect()->route('UsuarioPerfil.index')->with('success', 'Perfil creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un perfil
     */
    public function edit(UsuarioPerfil $perfil)
    {
        return view('UsuarioPerfil.edit', compact('perfil'));
    }

    /**
     * Actualiza un perfil en la base de datos
     */
    public function update(Request $request, UsuarioPerfil $perfil)
    {
        $request->validate([
            'perfil' => 'required',
        ]);

        $perfil->perfil = $request->input('perfil');
        //admin
        if ($request->input('admin') != null) {
            $perfil->admin = true;
        } else {
            $perfil->admin = false;
        }
        //insumos
        if ($request->input('insumos') != null) {
            $perfil->insumos = true;
        } else {
            $perfil->insumos = false;
        }
        //estadisticas
        if ($request->input('estadisticas') != null) {
            $perfil->estadisticas = true;
        } else {
            $perfil->estadisticas = false;
        }
        //pacientes
        if ($request->input('pacientes') != null) {
            $perfil->pacientes = true;
        } else {
            $perfil->pacientes = false;
        }
        //camas
        if ($request->input('camas') != null) {
            $perfil->camas = true;
        } else {
            $perfil->camas = false;
        }
        //cirugias
        if ($request->input('cirugias') != null) {
            $perfil->cirugias = true;
        } else {
            $perfil->cirugias = false;
        }
        
        $perfil->save();

        return redirect()->route('UsuarioPerfil.index')->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Elimina un perfil de la base de datos
     */
    public function destroy(UsuarioPerfil $perfil)
    {
        $perfil->delete();
        return redirect()->route('UsuarioPerfil.index')->with('success', 'Perfil eliminado correctamente.');
    }
    public function index()
    {
        $perfiles = UsuarioPerfil::all();
        $usuarios = User::all(); 

        return view('UsuarioPerfil.index', compact('perfiles', 'usuarios'));
    }
    public function actualizarRol(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|integer',
        ]);

        $usuario = User::findOrFail($id);
        $usuario->role = $request->role;
        $usuario->save();

        return redirect()->route('UsuarioPerfil.index')->with('success', 'Rol actualizado correctamente.');
    }
}
