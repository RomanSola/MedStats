<div class="container mt-2">

    @php
        $rutaActual = request()->route()->getName();

        switch ($rutaActual) {
            //Todos los que deben volver al inicio
            case 'stocks.index':
            case 'pacientes.index':
            case 'estadisticas':
            case 'camas.index':
            //case 'cirugias.index':
            case 'ajustes':
                $rutaAnterior = 'inicio';
                break;

            //Todos los que deben volver a Ajustes
            case 'usuarios.index':
            case 'empleados.index':
            case 'medicamentos.index':
            case 'cirugias.index':
            case 'habitaciones.index':
            case 'quirofanos.index':
            case 'camas.index':
            case 'procedimientos.index':
            case 'profesion.index':
            case 'tipoAnestesias.index':
            case 'ocupacionCamas.index':
            case 'UsuarioPerfil.index':
            case 'salas.index':
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
            case 'cirugias.estadisticas':
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
        <div class="mt-3"
            style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
            <a href="{{ route($rutaAnterior) }}"
                class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-circle border border-primary text-primary bg-white hover:bg-primary hover:text-white hover:shadow-lg transition-all duration-300 text-sm fw-semibold shadow"
                style="text-decoration: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                </svg>
            </a>
        </div>
    @endif

    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>
