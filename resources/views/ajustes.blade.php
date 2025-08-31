@extends('layouts.app')

@section('title', 'Ajustes del Sistema')

@section('contenido')
    <div class="py-5" style="background-color: #f4f6f8;">

        <div class="mb-6 text-center">
            <h1
                class="inline-block text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md px-2">
                AJUSTES DEL SISTEMA
            </h1>
        </div>



        <div class="container">

            {{-- Contenedor central sombreado --}}
            <div class="bg-white rounded-4 shadow-lg p-5">

                {{-- Título principal --}}


                {{-- Tarjetas --}}
                <div class="row g-4">

                    @php
                        $cardHeight = 'min-height: 190px;';
                        $cardBodyClass = 'card-body d-flex flex-column justify-content-between';
                        $borderColor = '#A3D9A5'; // verde pastel, igual que Medicamentos
                        $cards = [
                            [
                                'title' => 'Usuarios',
                                'text' => 'Dar de alta nuevos usuarios del sistema.',
                                'route' => '#',
                                'btn' => 'Dar de Alta Usuarios',
                                'disabled' => true,
                            ],
                            [
                                'title' => 'Medicamentos',
                                'text' => 'Agregar o editar medicamentos disponibles.',
                                'route' => route('medicamentos.index'),
                                'btn' => 'Ir a Medicamentos',
                            ],
                            [
                                'title' => 'Habitaciones',
                                'text' => 'Agregar habitaciones nuevas para asignación de camas.',
                                'route' => route('habitaciones.index'),
                                'btn' => 'Gestionar Habitación',
                            ],
                            [
                                'title' => 'Camas',
                                'text' => 'Agregar Nueva Cama.',
                                'route' => route('camas.create'),
                                'btn' => 'Gestionar Camas',
                            ],
                            [
                                'title' => 'Salas',
                                'text' => 'Definir salas del establecimiento y su capacidad.',
                                'route' => route('salas.index'),
                                'btn' => 'Gestionar Salas',
                            ],
                            [
                                'title' => 'Empleados',
                                'text' => 'Agregar empleados y definir su profesión.',
                                'route' => route('empleados.index'),
                                'btn' => 'Ir a Empleados',
                            ],
                            [
                                'title' => 'Cirugías',
                                'text' => 'Ver o agregar nombres de cirugías.',
                                'route' => route('cirugias.index'),
                                'btn' => 'Ir a Cirugías',
                            ],
                            [
                                'title' => 'Roles de Usuario',
                                'text' => 'Gestionar los perfiles y permisos del sistema.',
                                'route' => route('UsuarioPerfil.index'),
                                'btn' => 'Ver Roles',
                            ],
                            [
                                'title' => 'Tipos de Anestesia',
                                'text' => 'Agregar tipos de anestesia.',
                                'route' => route('tipoAnestesias.index'),
                                'btn' => 'Ir a Anestesias',
                            ],
                            [
                                'title' => 'Quirófanos',
                                'text' => 'Gestionar quirófanos habilitados para cirugías.',
                                'route' => route('quirofanos.index'),
                                'btn' => 'Gestionar Quirófanos',
                            ],
                            [
                                'title' => 'Profesiones',
                                'text' => 'Definir nuevas profesiones del personal.',
                                'route' => route('profesion.index'),
                                'btn' => 'Ver Profesiones',
                            ],
                            [
                                'title' => 'Procedimientos',
                                'text' => 'Administrar tipos de procedimientos quirúrgicos.',
                                'route' => route('procedimientos.index'),
                                'btn' => 'Ir a Procedimientos',
                            ],
                        ];
                    @endphp

                    @foreach ($cards as $card)
                        <div class="col-lg-4 col-md-6">
                            <div class="card soft-card mb-4" style="border: 2px solid {{ $borderColor }};">
                                <div class="{{ $cardBodyClass }}" style="{{ $cardHeight }}">
                                    <div>
                                        <h5 class="card-title fw-semibold">{{ $card['title'] }}</h5>
                                        <p class="card-text text-muted">{{ $card['text'] }}</p>
                                    </div>
                                    <a href="{{ $card['route'] }}"
                                        class="btn soft-btn mt-3 {{ $card['disabled'] ?? false ? 'disabled' : '' }}">
                                        {{ $card['btn'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>
    <style>
    .soft-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .soft-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.08);
    }

    .soft-btn {
        background-color: #333;
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 500;
        border: none;
        transition: background-color 0.3s ease, color 0.3s ease;
        cursor: pointer;
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }

    .soft-btn:hover {
        background-color: #080808; /* fondo más oscuro */
        color: white;           /* texto asegurado blanco para buen contraste */
        /* opcional: agregar sombra al texto para mejor legibilidad */
        text-shadow: 0 0 3px rgba(90, 197, 165, 0.541);
    }

    .card-title {
        color: #1e1e1e;
    }
</style>

@endsection
