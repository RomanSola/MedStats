@extends('layouts.app')
@section('titulo', 'Crear Perfil')
@section('contenido')
<h1 class="mb-4">Agregar Nuevo Perfil</h1>
<form action="{{ route('UsuarioPerfil.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="perfil" class="form-label">Perfil</label>
        <input type="text" name="perfil" id="perfil" class="form-control" required>
    </div>
    <button class="btn btn-primary">Agregar</button>
</form>
@endsection