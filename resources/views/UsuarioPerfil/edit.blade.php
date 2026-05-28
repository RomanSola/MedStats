@extends('layouts.app')

@section('titulo', 'Editar Perfil')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    <div class="flex justify-between items-center mb-6">
        <h1
            class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
            Editar Perfil
        </h1>
    </div>

    {{-- Contenedor con borde gris institucional --}}
    <div class="card border shadow-sm">
        <div class="card-body">

            <form action="{{ route('UsuarioPerfil.update', $perfil) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Campo Perfil --}}
                <div>
                    <label for="perfil" class="form-label fw-semibold text-secondary">
                        Perfil
                    </label>
                    <input type="text" name="perfil" id="perfil"
                        class="form-control border shadow-sm"
                        value="{{ old('perfil', $perfil->perfil) }}">
                    @error('perfil')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Checkboxes estilizados --}}
                @php
                    $opciones = [
                        'admin' => 'Administrador',
                        'insumos' => 'Insumos',
                        'pacientes' => 'Pacientes',
                        'estadisticas' => 'Estadísticas',
                        'camas' => 'Camas',
                        'cirugias' => 'Cirugías',
                    ];
                @endphp

                @foreach ($opciones as $campo => $etiqueta)
                    <div class="switches-group-compact">
                        <span class="switch-label">{{ $etiqueta }}</span>
                        <label class="switch">
                            <input type="checkbox" name="{{ $campo }}" id="{{ $campo }}"
                                {{ old($campo, $perfil->$campo) ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                @endforeach

                {{-- Botones --}}
                <div class="flex justify-between pt-4">
                    <a href="{{ route('UsuarioPerfil.index') }}"
                        class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                        style="text-decoration: none;">
                        Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Estilos personalizados --}}
<style>
    /* Grupo general */
    .switches-group-compact {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #f8fafc;
        border: 1px solid #d1d5db;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        margin-bottom: 0.75rem;
        transition: all 0.2s ease-in-out;
    }

    .switches-group-compact:hover {
        background-color: #f1f5f9;
        box-shadow: 0 0 8px rgba(27, 125, 143, 0.15);
    }

    .switch-label {
        font-weight: 600;
        color: #334155;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 48px;
        height: 26px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #cbd5e1;
        transition: 0.4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background: linear-gradient(90deg, #1B7D8F, #2BA8A0);
    }

    input:checked + .slider:before {
        transform: translateX(22px);
    }

    .slider.round {
        border-radius: 34px;
    }
</style>
@endsection
