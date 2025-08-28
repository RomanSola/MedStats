@extends('layouts.app')

@section('title', 'Ajustes del Sistema')

@section('contenido')

<div class="container py-4">

    {{-- Título institucional --}}
    <h2
        class="text-center text-3xl fw-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow mb-4 font-monospace">
        ⚙️ AJUSTES DEL SISTEMA
    </h2>

    <div class="card border-secondary shadow-sm mb-4">
        <br>

        {{-- Tarjetas centradas y proporcionadas --}}
        <div class="mx-auto" style="max-width: 1140px;">
            <div class="row g-4">

                @php
                    $cardHeight = 'min-height: 190px;';
                    $cardBodyClass = 'card-body d-flex flex-column justify-content-between';
                @endphp

                {{-- Usuarios --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Usuarios
                                </h5>
                                <p class="card-text">Dar de alta nuevos usuarios del sistema.</p>
                            </div>
                            <a href="#" class="btn btn-outline-dark mt-3">Dar de Alta Usuarios</a>
                        </div>
                    </div>
                </div>

                {{-- Medicamentos --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Medicamentos
                                </h5>
                                <p class="card-text">Agregar o editar medicamentos disponibles.</p>
                            </div>
                            <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-dark mt-3">Ir a Medicamentos</a>
                        </div>
                    </div>
                </div>

                {{-- Habitaciones --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Habitaciones
                                </h5>
                                <p class="card-text">Agregar habitaciones nuevas para asignación de camas.</p>
                            </div>
                            <a href="{{ route('habitaciones.index') }}" class="btn btn-outline-dark mt-3">Gestionar Habitación</a>
                        </div>
                    </div>
                </div>

                {{-- Salas --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Salas
                                </h5>
                                <p class="card-text">Definir salas del establecimiento y su capacidad.</p>
                            </div>
                            <a href="{{ route('salas.index') }}" class="btn btn-outline-dark mt-3">Gestionar Salas</a>
                        </div>
                    </div>
                </div>

                {{-- Empleados --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Empleados
                                </h5>
                                <p class="card-text">Agregar empleados y definir su profesión.</p>
                            </div>
                            <a href="{{ route('empleados.index') }}" class="btn btn-outline-dark mt-3">Ir a Empleados</a>
                        </div>
                    </div>
                </div>

                {{-- Cirugías --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Cirugías
                                </h5>
                                <p class="card-text">Ver o agregar nombres de cirugías.</p>
                            </div>
                            <a href="{{ route('cirugias.index') }}" class="btn btn-outline-dark mt-3">Ir a Cirugías</a>
                        </div>
                    </div>
                </div>

                {{-- Roles de Usuario --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Roles de Usuario
                                </h5>
                                <p class="card-text">Gestionar los perfiles y permisos del sistema.</p>
                            </div>
                            <a href="{{ route('UsuarioPerfil.index') }}" class="btn btn-outline-dark mt-3">Ver Roles</a>
                        </div>
                    </div>
                </div>

                {{-- Tipos de Anestesia --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Tipos de Anestesia
                                </h5>
                                <p class="card-text">Agregar tipos de anestesia.</p>
                            </div>
                            <a href="{{ route('tipoAnestesias.index') }}" class="btn btn-outline-dark mt-3">Ir a Anestesias</a>
                        </div>
                    </div>
                </div>

                {{-- Quirófanos --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Quirófanos
                                </h5>
                                <p class="card-text">Gestionar quirófanos habilitados para cirugías.</p>
                            </div>
                            <a href="{{ route('quirofanos.index') }}" class="btn btn-outline-dark mt-3">Gestionar Quirófanos</a>
                        </div>
                    </div>
                </div>

                {{-- Profesiones --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Profesiones
                                </h5>
                                <p class="card-text">Definir nuevas profesiones del personal.</p>
                            </div>
                            <a href="{{ route('profesion.index') }}" class="btn btn-outline-dark mt-3">Ver Profesiones</a>
                        </div>
                    </div>
                </div>

                {{-- Procedimientos --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-[2px] border-[#198754] shadow-sm mb-4">
                        <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                            <div>
                                <h5 class="card-title text-gray-800 font-semibold tracking-normal drop-shadow-sm text-lg md:text-xl">
                                    Procedimientos
                                </h5>
                                <p class="card-text">Administrar tipos de procedimientos quirúrgicos.</p>
                            </div>
                            <a href="{{ route('procedimientos.index') }}" class="btn btn-outline-dark mt-3">Ir a Procedimientos</a>
                        </div>
                    </div>
                </div>

            </div> <!-- .row -->
        </div> <!-- .mx-auto -->
    </div> <!-- .card -->

</div> <!-- .container -->

@endsection
