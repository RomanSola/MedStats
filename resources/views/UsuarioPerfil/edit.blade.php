@extends('layouts.app')
@section('titulo', 'Editar Perfil')
@section('contenido')
<h1 class="mb-4">Editar Perfil</h1>
<form action="{{ route('UsuarioPerfil.update', $perfil) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="perfil" class="form-label">Perfil</label>
        <input type="text" name="perfil" id="perfil" class="form-control" value="{{ $perfil->perfil }}" required>
    </div>
    <button class="btn btn-primary">Guardar</button>
</form>
@endsection