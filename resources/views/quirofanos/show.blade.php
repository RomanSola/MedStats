@extends('layouts.app')

@section('title', 'Ver Quirofano')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Detalle del Quirofano</h2>

    <div class="card border-info">
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label class="form-label">Quirofano</label>
                    <input type="text" class="form-control" value="{{ $quirofano->nombre }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <input type="text" class="form-control" value="{{ $quirofano->descripcion }}" readonly>
                </div>

                <a href="{{ route('quirofanos.index') }}" class="btn btn-outline-secondary">← Volver al listado</a>
            </form>
        </div>
    </div>
</div>
@endsection
