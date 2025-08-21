@extends('layouts.app')

@section('title', 'Ajustes del Sistema')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Ajustes del Sistema</h2>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Dar de alta nuevos usuarios del sistema.</p>
                    <a href="#" class="btn btn-primary disabled text-decoration-none">Dar de Alta Usuarios</a> <!-- No funcional aún -->
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title">Medicamentos</h5>
                    <p class="card-text">Agregar o editar medicamentos disponibles.</p>
                    <a href="{{ route('medicamentos.index') }}" class="btn btn-success">Ir a Medicamentos</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-secondary">
                <div class="card-body">
                    <h5 class="card-title">Habitaciones</h5>
                    <p class="card-text">Agregar habitaciones nuevas para asignación de camas.</p>
                    <a href="{{ route('habitaciones.index') }}" class="btn btn-secondary">Gestionar Habitación</a>
                </div>
            </div>
        </div>


        <div class="col-md-6 mb-3">
            <div class="card border-info">
                <div class="card-body">
                    <h5 class="card-title">Salas</h5>
                    <p class="card-text">Definir salas del establecimiento y su capacidad.</p>
                    <a href="{{ route('salas.index') }}" class="btn btn-dark">Gestionar Salas</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Empleados</h5>
                    <p class="card-text">Agregar empleados y definir su profesión.</p>
                    <a href="{{ route('empleados.index') }}" class="btn btn-warning">Ir a Empleados</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-info">
                <div class="card-body">
                    <h5 class="card-title">Cirugías</h5>
                    <p class="card-text">Ver o agregar nombres de cirugías.</p>
                    <a href="{{ route('procedimientos.index') }}" class="btn btn-info">Ir a Cirugías</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title">Roles de Usuario</h5>
                    <p class="card-text">Gestionar los perfiles y permisos del sistema.</p>
                    <a href="{{ route('UsuarioPerfil.index') }}" class="btn btn-primary  text-decoration-none">Ver Roles</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-secondary">
                <div class="card-body">
                    <h5 class="card-title">Tipos de Anestesia</h5>
                    <p class="card-text">Agregar tipos de anestesia.</p>
                    <a href="{{ route('tipoAnestesias.index') }}" class="btn btn-secondary">Ir a Anestesias</a>
                </div>
            </div>
        </div>


        <div class="col-md-6 mb-3">
            <div class="card border-info">
                <div class="card-body">
                    <h5 class="card-title">Quirófanos</h5>
                    <p class="card-text">Gestionar quirófanos habilitados para cirugías.</p>
                    <a href="{{ route('quirofanos.index') }}" class="btn btn-dark disable">Gestionar Quirófanos</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Profesiones</h5>
                    <p class="card-text">Definir nuevas profesiones del personal.</p>
                    <a href="{{ route('profesion.index') }}" class="btn btn-warning disable">Ver Profesiones</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-info">
                <div class="card-body">
                    <h5 class="card-title">Procedimientos</h5>
                    <p class="card-text">Administrar tipos de procedimientos quirúrgicos.</p>
                    <a href="{{ route('procedimientos.index') }}"  class="btn btn-info disable">Ir a Procedimientos</a>
                </div>
            </div>
        </div>

    </div>
    @endsection