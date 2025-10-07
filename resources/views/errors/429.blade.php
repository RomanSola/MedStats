@extends('layouts.app')

@section('title', 'Demasiadas solicitudes')
@section('contenido')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-body text-center">
                        <h1 class="display-3 text-danger">429</h1>
                        <h2 class="mb-4">Demasiadas solicitudes</h2>
                        <p class="lead">Has realizado demasiadas solicitudes. Por favor, espera un momento antes de volver a intentarlo.</p>
                        <a href="{{ route('inicio') }}" class="btn btn-secondary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

