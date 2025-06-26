<div>

    @php
        $rutaActual = request()->route()->getName();

        switch ($rutaActual) {

            case 'stocks.index':
            case 'pacientes.index':
            case 'estadisticas':
            case 'camas.index':
            case 'ajustes':
                $rutaAnterior = 'inicio';
                break;

            case 'usuarios.index':
            case 'empleados.index':
            case 'medicamentos.index':
            case 'cirugias.index':
            case 'salas.index':
            case 'habitaciones.index':
            
                $rutaAnterior = 'ajustes';
                break;

            case 'empleados.create':
            case 'empleados.edit':
            case 'empleados.show':
                $rutaAnterior = 'empleados.index';
                break;

            case 'stocks.create':
            case 'stocks.edit':
            case 'stocks.show':
                $rutaAnterior = 'stocks.index';
                break;

            case 'tipoAnestesias.create':
            case 'tipoAnestesias.edit':
                $rutaAnterior = 'tipoAnestesias.index';
                break;

            case 'profesion.create':
            case 'profesion.edit':
            case 'profesion.show':
                $rutaAnterior = 'profesion.index';
                break;

            case 'pacientes.create':
            case 'pacientes.edit':
            case 'pacientes.show':
                $rutaAnterior = 'pacientes.index';
                break;

            case 'ocupacionCamas.create':
            case 'ocupacionCamas.edit':
            case 'ocupacionCamas.show':
            case 'ocupacionCamas.darAlta':
                $rutaAnterior = 'ocupacionCamas.index';
                break;

            case 'medicamentos.create':
            case 'medicamentos.edit':
                $rutaAnterior = 'medicamentos.index';
                break;

            case 'procedimientos.create':
            case 'procedimientos.edit':
            case 'procedimientos.show':
                $rutaAnterior = 'procedimientos.index';
                break;

            case 'habitaciones.create':
            case 'habitaciones.edit':
                $rutaAnterior = 'habitaciones.index';
                break;

            case 'UsuarioPerfil.create':
            case 'UsuarioPerfil.edit':
                $rutaAnterior = 'UsuarioPerfil.index';
                break;

            case 'salas.create':
            case 'salas.edit':
                $rutaAnterior = 'salas.index';
                break;
                
            default:
                $rutaAnterior = 'inicio';
                break;
        }
    @endphp

    @if ($rutaActual !== 'inicio')
        <a href="{{ route($rutaAnterior) }}" class="btn btn-outline-secondary mt-3">
            ← Volver atrás
        </a>
    @endif


    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>
