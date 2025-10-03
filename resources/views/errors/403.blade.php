<!-- resources/views/errors/403.blade.php -->

@extends('layouts.app')

@section('title', 'Acceso denegado')

@section('contenido')
    <div class="container text-center mt-5">
        <div class="alert alert-danger w-50 mx-auto">
            <h1 class="display-3">403</h1>
            <p class="lead">{{ $exception->getMessage() ?: 'Forbidden'}}</p>
        </div>
    </div>
@endsection