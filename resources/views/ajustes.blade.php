@extends('layouts.app')

@section('title', 'Ajustes del Sistema')

@section('contenido')
<div class="container py-4">

    {{-- Título institucional --}}
    <h2 class="text-center text-3xl fw-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow mb-4 font-monospace">
        ⚙️ AJUSTES DEL SISTEMA
    </h2>

    {{-- Tarjetas centradas y proporcionadas --}}
    <div class="mx-auto" style="max-width: 1140px;">
        <div class="row g-4">

            {{-- Usuarios --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-primary shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Usuarios</h5>
                        <p class="card-text">Dar de alta nuevos usuarios del sistema.</p>
                        <a href="#" class="btn btn-outline-primary disabled">Dar de Alta Usuarios</a>
                    </div>
                </div>
            </div>

            {{-- Medicamentos --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-success shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-success">Medicamentos</h5>
                        <p class="card-text">Agregar o editar medicamentos disponibles.</p>
                        <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-success">Ir a Medicamentos</a>
                    </div>
                </div>
            </div>

            {{-- Habitaciones --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-secondary shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">Habitaciones</h5>
                        <p class="card-text">Agregar habitaciones nuevas para asignación de camas.</p>
                        <a href="{{ route('habitaciones.index') }}" class="btn btn-outline-secondary">Gestionar Habitación</a>
                    </div>
                </div>
            </div>

            {{-- Salas --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-info shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-info">Salas</h5>
                        <p class="card-text">Definir salas del establecimiento y su capacidad.</p>
                        <a href="{{ route('salas.index') }}" class="btn btn-outline-info">Gestionar Salas</a>
                    </div>
                </div>
            </div>

            {{-- Empleados --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-warning shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Empleados</h5>
                        <p class="card-text">Agregar empleados y definir su profesión.</p>
                        <a href="{{ route('empleados.index') }}" class="btn btn-outline-warning">Ir a Empleados</a>
                    </div>
                </div>
            </div>

            {{-- Cirugías --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-danger shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Cirugías</h5>
                        <p class="card-text">Ver o agregar nombres de cirugías.</p>
                        <a href="{{ route('cirugias.index') }}" class="btn btn-outline-danger">Ir a Cirugías</a>
                    </div>
                </div>
            </div>

            {{-- Roles de Usuario --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-dark shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-dark">Roles de Usuario</h5>
                        <p class="card-text">Gestionar los perfiles y permisos del sistema.</p>
                        <a href="{{ route('UsuarioPerfil.index') }}" class="btn btn-outline-dark">Ver Roles</a>
                    </div>
                </div>
            </div>

            {{-- Tipos de Anestesia --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-success shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-success">Tipos de Anestesia</h5>
                        <p class="card-text">Agregar tipos de anestesia.</p>
                        <a href="{{ route('tipoAnestesias.index') }}" class="btn btn-outline-success">Ir a Anestesias</a>
                    </div>
                </div>
            </div>

            {{-- Quirófanos --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-info shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-info">Quirófanos</h5>
                        <p class="card-text">Gestionar quirófanos habilitados para cirugías.</p>
                        <a href="{{ route('quirofanos.index') }}" class="btn btn-outline-info">Gestionar Quirófanos</a>
                    </div>
                </div>
            </div>

            {{-- Profesiones --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-warning shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Profesiones</h5>
                        <p class="card-text">Definir nuevas profesiones del personal.</p>
                        <a href="{{ route('profesion.index') }}" class="btn btn-outline-warning">Ver Profesiones</a>
                    </div>
                </div>
            </div>

            {{-- Procedimientos --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-danger shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Procedimientos</h5>
                        <p class="card-text">Administrar tipos de procedimientos quirúrgicos.</p>
                        <a href="{{ route('procedimientos.index') }}" class="btn btn-outline-danger">Ir a Procedimientos</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
