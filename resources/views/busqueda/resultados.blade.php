@extends('layouts.app')

@section('title', 'Búsqueda')

@section("contenido")

<center>
@if(isset($persona))
    <h1>{{ $persona->nombre }} {{ $persona->apellido }}</h1>
    <p>DNI: {{ $persona->dni }}</p>

    {{-- Mostrar remedios solo si existe la relación y datos --}}
    @if($persona->remedios && $persona->remedios->isNotEmpty())
        <h3>Remedios:</h3>
        <ul>
            @foreach ($persona->remedios as $remedio)
                <li>{{ $remedio->remedios }} (Cantidad: {{ $remedio->cantidad }})</li>
            @endforeach
        </ul>
    @else
        <p>No tiene remedios asignados aún.</p>
    @endif

@elseif(isset($resultados))
    <h2>Resultados para "{{ $busqueda }}"</h2>
    @if($resultados->isEmpty())
        <p>No se encontraron coincidencias.</p>
    @else
        <ul>
            @foreach ($resultados as $persona)
                <li><a href="{{ route('persona.ver', $persona->id) }}">{{ $persona->nombre }} {{ $persona->apellido }} - DNI: {{ $persona->dni }}</a></li>
            @endforeach
        </ul>
    @endif
@endif
</center>
@endsection

