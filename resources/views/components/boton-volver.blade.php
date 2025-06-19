<div>

@php
    $rutaActual = request()->route()->getName();
@endphp

@if($rutaActual !== 'inicio')
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-3">
        ← Volver atrás
    </a>
@endif


    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>