<div class="container mt-2">

    @php
        $rutaActual = request()->route()->getName();

        switch ($rutaActual) {
            //Todos los que deben volver al inicio
            case 'stocks.index':
            case 'pacientes.index':
            case 'estadisticas':
            case 'camas.index':
            case 'cirugias.index':
            case 'ajustes':
                $rutaAnterior = 'inicio';
                break;
            //Todos los que deben volver a Ajustes
            case 'usuarios.index':
            case 'empleados.index':
            case 'medicamentos.index':
            case 'cirugias.index':
            case 'salas.index':
            case 'habitaciones.index':
            case 'quirofanos.index':
            case 'camas.index';  
            case 'procedimientos.index': 
            case 'profesion.index': 
            case 'tipoAnestesias.index':
            case 'ocupacionCamas.index':  
                $rutaAnterior = 'ajustes';
                break;

             case 'profesion.create':
            case 'profesion.edit':
            case 'profesion.show':
                $rutaAnterior = 'profesion.index';
                break;    

            case 'procedimientos.create':
            case 'procedimientos.edit':
            case 'procedimientos.show':
                $rutaAnterior = 'procedimientos.index';
                break;

            case 'camas.create':
            case 'camas.edit':
            case 'camas.show':
                $rutaAnterior = 'camas.index';
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
                
            case 'cirugias.create':
            case 'cirugias.edit':
            case 'cirugias.show':
                $rutaAnterior = 'cirugias.index';
                break;

            case 'quirofanos.create':
            case 'quirofanos.edit':
            case 'quirofanos.show':
                $rutaAnterior = 'quirofanos.index';
                break;

            // Por default vuelve al inicio
            default:
                $rutaAnterior = 'inicio';
                break;
        }
    @endphp

    @if ($rutaActual !== 'inicio')
        <a href="{{ route($rutaAnterior) }}" class="btn btn-outline-primary mt-1">
            ← Volver atrás
        </a>
    @endif
    


    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>
