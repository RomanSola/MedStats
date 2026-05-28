@extends('layouts.app')

@section('title', 'No autorizado')
@section('contenido')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-body text-center">
                        <h1 class="display-3 text-danger">401</h1>
                        <h2 class="mb-4">No autorizado</h2>
                        <p class="lead">Debes iniciar sesión para acceder a esta página.</p>
                        <a href="{{ route('inicio') }}" class="btn btn-secondary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
