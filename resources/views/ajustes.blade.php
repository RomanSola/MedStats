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
                    <a href="#" class="btn btn-primary disabled">Dar de Alta Usuarios</a> <!-- No funcional aún -->
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
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Salas</h5>
                    <p class="card-text">Agregar salas y su descripcion.</p>
                    <a href="{{ route('salas.index') }}" class="btn btn-warning">Ir a agregar salas</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-info">
                <div class="card-body">
                    <h5 class="card-title">Habitaciones</h5>
                    <p class="card-text">Ver o agregar habitaciones.</p>
                    <a href="{{ route('habitaciones.index') }}" class="btn btn-info">Ir a agregar habitaciones</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection