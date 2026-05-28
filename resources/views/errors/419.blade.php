@extends('layouts.app')

@section('title', 'Página expirada')
@section('contenido')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-body text-center">
                        <h1 class="display-3 text-danger">419</h1>
                        <h2 class="mb-4">Págna expirada</h2>
                        <p class="lead">La página ha expirado. Por favor, vuelve a intentarlo.</p>
                        <a href="{{ route('inicio') }}" class="btn btn-secondary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection