@extends('layouts.app')

@section('titulo', 'Crear Habitación')

@section('contenido')
    <div class="max-w-xl mx-auto px-4 py-4">

        {{-- Título institucional gris --}}
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                Agregar Nueva Habitación</h1>
        </div>

        {{-- Contenedor con borde gris institucional --}}
        <div class="card border shadow-sm">
            <div class="card-body">

                <form action="{{ route('habitaciones.store') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Número de habitación --}}
                    <div>
                        <label for="numero" class="form-label fw-semibold ">
                            Número de habitación
                        </label>
                        <input type="text" name="numero" id="numero" class="form-control border shadow-sm">
                        @error('numero')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Sala --}}
                    <div>
                        <label for="sala_id" class="form-label fw-semibold">
                            Sala
                        </label>
                        <select name="sala_id" id="sala_id" class="form-select border  shadow-sm">
                            <option value="">Seleccione una Sala</option>
                            @foreach ($salas as $sala)
                                <option value="{{ $sala->id }}" {{ old('sala_id') == $sala->id ? 'selected' : '' }}>
                                    {{ $sala->nombre }} - {{ $sala->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('sala_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    {{-- Botón --}}
                    <div class="flex justify-between pt-4">

                        <a href="{{ route('habitaciones.index') }}"
                            class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                            style="text-decoration: none;">
                            Agregar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="sala_id" class="form-label">Sala</label>
        <select name="sala_id" id="sala_id" class="form-control">
            <option value="">Seleccione una Sala</option>
            @foreach($salas as $sala)
            <option value="{{ $sala->id }}"
                {{ old('sala_id') == $sala->id ? 'selected' : '' }}>
                {{ $sala->nombre }} - {{ $sala->descripcion }}
            </option>
            @endforeach
        </select>
        @error('sala_id')
        <small class="text-danger"> {{ $message }} </small>
        @enderror
    </div>
    <button class="btn btn-primary">Agregar</button>
</form>
@endsection
