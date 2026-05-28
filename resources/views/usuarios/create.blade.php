@extends('layouts.app')
@section('title', 'Crear Usuario')
@section('contenido')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md px-2">
            Crear Nuevo Usuario
        </h1>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
            Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Service Assignment Section -->
                <div class="mb-4">
                    <div class="border rounded-lg p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-color: #1B7D8F !important;">
                        <div class="d-flex align-items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1B7D8F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <h6 class="mb-0 fw-bold" style="color: #1B7D8F;">Control de Acceso por Servicio</h6>
                        </div>
                        
                        <label for="servicio_id" class="form-label fw-semibold">Servicio Asignado</label>
                        <select name="servicio_id" id="servicio_id" class="form-select @error('servicio_id') is-invalid @enderror" style="border-width: 2px;">
                            <option value="">🌐 Sin restricción (Acceso Global)</option>
                            @foreach($servicios as $servicio)
                                <option value="{{ $servicio->id }}" {{ old('servicio_id') == $servicio->id ? 'selected' : '' }}>
                                    🏥 {{ $servicio->nombre }}
                                </option>
                            @endforeach
                        </select>
                        
                        <div class="alert alert-info mt-3 mb-0" style="background-color: #e7f3f5; border-color: #1B7D8F; border-left-width: 4px;">
                            <div class="d-flex align-items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="me-2 flex-shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1B7D8F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                </svg>
                                <div>
                                    <strong>Acceso Global:</strong> El usuario podrá ver y gestionar el stock de todos los servicios.<br>
                                    <strong>Servicio Específico:</strong> El usuario solo tendrá acceso al stock del servicio seleccionado.
                                </div>
                            </div>
                        </div>
                        
                        @error('servicio_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" style="background-color: #1B7D8F; border-color: #1B7D8F;">
                        Crear Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
