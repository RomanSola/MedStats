@extends('layouts.app')
@section('titulo', 'Modificar Stock')
@section('contenido')
    <h1 class="mb-4">Modificar Stock</h1>
    <form action="{{ route('stocks.update', $stock) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="medicamento" class="form-label">Medicamento</label>
            <input type="text" name="medicamento" id="medicamento" class="form-control"
                value="{{ $stock->get_medicamento->nombre }}" readonly>
            <input type="hidden" name="medicamento_id" id="medicamento_id" class="form-control"
                value="{{ $stock->medicamento_id }}">

            <label for="lote" class="form-label">Lote</label>
            <input type="input" name="lote" id="lote" class="form-control" value="{{ $stock->lote }}" readonly>
            @error('lote')
                <small class="text-danger"> {{ $message }} </small>
            @enderror

            <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
            <input type="text" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control"
                value="{{ $stock->fecha_vencimiento }}" readonly>
            @error('fecha_vencimiento')
                <small class="text-danger"> {{ $message }} </small>
            @enderror

            <label for="cantidad_act" class="form-label">Cantidad Actual</label>
            <input type="number" name="cantidad_act" id="cantidad_act" class="form-control"
                value="{{ $stock->cantidad_act }}" readonly>
            @error('cantiad_act')
                <small class="text-danger"> {{ $message }} </small>
            @enderror

            <label for="cantidad_mod" class="form-label">Agregar/Extraer Cantidad</label>
            <input type="number" name="cantidad_mod" id="cantidad_mod" class="form-control" required>
            @error('cantidad_mod')
                <small class="text-danger"> {{ $message }} </small>
            @enderror

            <div class="mb-3">
                <label for="paciente_id" class="form-label">El medicamento es para el paciente</label>
                <select name="paciente_id" id="paciente_id" class="form-control">
                    <option value="">Seleccione un Paciente</option>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                            {{ $paciente->nombre }} {{ $paciente->apellido }} DNI {{ $paciente->dni }}
                        </option>
                    @endforeach
                </select>
                @error('paciente_id')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="empleado_id" class="form-label">El medicamento es recetado por</label>
                <select name="empleado_id" id="empleado_id" class="form-control">
                    <option value="">Seleccione un Médico</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                            {{ $empleado->nombre }} {{ $empleado->apellido }} DNI {{ $empleado->dni }}
                        </option>
                    @endforeach
                </select>
                @error('empleado_id')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <label for="comentario" class="form-label">Comentario</label>
            <input type="text" name="comentario" id="comentario" class="form-control">
            @error('comentario')
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>
        <button class="btn btn-primary">Guardar</button>
    </form>
@endsection
