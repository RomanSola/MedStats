@extends('layouts.app')
@section('titulo', 'Ingresar Medicamento')
@section('contenido')
<h1 class="mb-4">Ingresar nuevo medicamento al Stock</h1>
<form action="{{ route('stocks.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="medicamento_id" class="form-label">Medicamento</label>
        <select name="medicamento_id" id="medicamento_id" class="form-control">
            @foreach($medicamentos as $id => $nombre)
                <option value="{{ $id }}"
                    {{ old('medicamento_id') == $id ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
            @endforeach
        </select>
        @error('medicamento_id')
        <small class="text-danger"> {{ $message }} </small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="cantidad_act" class="form-label">Cantidad</label>
        <input type="number" name="cantidad_act" id="cantidad_act" class="form-control" required>
        <label for="lote" class="form-label">Lote</label>
        <input type="text" name="lote" id="lote" class="form-control" required>
        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" required>
    </div>
    <button class="btn btn-primary">Agregar</button>
</form>
@endsection