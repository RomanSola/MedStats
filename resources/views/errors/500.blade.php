@extends('layouts.app')

@section('title', 'Error interno del servidor')
@section('contenido')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-body text-center">
                        <h1 class="display-3 text-danger">500</h1>
                        <h2 class="mb-4">Error interno del servidor</h2>
                        <p class="lead">Ha ocurrido un error interno en el servidor. Por favor, vuelve a intentarlo mas tarde.</p>
                        <a href="{{ route('inicio') }}" class="btn btn-secondary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
