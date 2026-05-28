<!-- resources/views/errors/403.blade.php -->

@extends('layouts.app')

@section('title', 'Acceso denegado')

@section('contenido')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-body text-center">
                        <h1 class="display-3 text-danger">403</h1>
                        <h2 class="mb-4">Acceso denegado</h2>
                        <p class="lead">No tienes permiso para acceder a esta página.</p>
                        <a href="{{ route('inicio') }}" class="btn btn-secondary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection