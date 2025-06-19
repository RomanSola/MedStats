@extends('layouts.app')

@section('title', 'Ver Procedimiento')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Detalle del Procedimiento</h2>

    <div class="card border-info">
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label class="form-label">Procedimiento</label>
                    <input type="text" class="form-control" value="{{ $procedimiento->nombre_procedimiento }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <input type="text" class="form-control" value="{{ $procedimiento->descripcion }}" readonly>
                </div>

                <a href="{{ route('procedimientos.index') }}" class="btn btn-outline-secondary">← Volver al listado</a>
            </form>
        </div>
    </div>
</div>
@endsection
