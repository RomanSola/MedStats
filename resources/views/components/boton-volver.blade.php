<div class="container mt-2">

    @php
        $rutaActual = request()->route()->getName();

        switch ($rutaActual) {
            // Rutas que vuelven al inicio
            case 'stocks.index':
            case 'pacientes.index':
            case 'estadisticas':
            case 'camas.index':
            //case 'cirugias.index':
            case 'ajustes':
                $rutaAnterior = 'inicio';
                break;

            // Rutas que vuelven a Ajustes
            case 'usuarios.index':
            case 'empleados.index':
            case 'medicamentos.index':
            case 'salas.index':
            case 'habitaciones.index':
            case 'quirofanos.index':
            case 'procedimientos.index':
            case 'profesion.index':
            case 'tipoAnestesias.index':
            case 'ocupacionCamas.index':
            case 'perfiles.index':
                $rutaAnterior = 'ajustes';
                break;
            //Perfiles
            case 'perfiles.create':
            case 'perfiles.edit':
                $rutaAnterior = 'perfiles.index';
            // Profesión
            case 'profesion.create':
            case 'profesion.edit':
            case 'profesion.show':
                $rutaAnterior = 'profesion.index';
                break;

            // Procedimientos
            case 'procedimientos.create':
            case 'procedimientos.edit':
            case 'procedimientos.show':
                $rutaAnterior = 'procedimientos.index';
                break;

            // Camas
            case 'camas.create':
            case 'camas.edit':
            case 'camas.show':
                $rutaAnterior = 'camas.index';
                break;

            // Empleados
            case 'empleados.create':
            case 'empleados.edit':
            case 'empleados.show':
                $rutaAnterior = 'empleados.index';
                break;

            // Stocks
            case 'stocks.create':
            case 'stocks.edit':
            case 'stocks.show':
                $rutaAnterior = 'stocks.index';
                break;

            // Tipo Anestesias
            case 'tipoAnestesias.create':
            case 'tipoAnestesias.edit':
                $rutaAnterior = 'tipoAnestesias.index';
                break;

            // Pacientes
            case 'pacientes.create':
            case 'pacientes.edit':
            case 'pacientes.show':
            case 'pacientes.asignar':
                $rutaAnterior = 'pacientes.index';
                break;

            // Ocupación de camas
            case 'ocupacionCamas.create':
            case 'ocupacionCamas.edit':
            case 'ocupacionCamas.show':
            case 'ocupacionCamas.darAlta':
                $rutaAnterior = 'ocupacionCamas.index';
                break;

            // Medicamentos
            case 'medicamentos.create':
            case 'medicamentos.edit':
                $rutaAnterior = 'medicamentos.index';
                break;

            // Usuarios
            case 'usuarios.create':
            case 'usuarios.edit':
            case 'usuarios.show':
                $rutaAnterior = 'usuarios.index';
                break;

            // Habitaciones
            case 'habitaciones.create':
            case 'habitaciones.edit':
                $rutaAnterior = 'habitaciones.index';
                break;

            // UsuarioPerfil
            case 'UsuarioPerfil.create':
            case 'UsuarioPerfil.edit':
                $rutaAnterior = 'UsuarioPerfil.index';
                break;

            // Salas
            case 'salas.create':
            case 'salas.edit':
                $rutaAnterior = 'salas.index';
                break;

            // Cirugías
            case 'cirugias.create':
            case 'cirugias.edit':
            case 'cirugias.show':
            case 'cirugias.estadisticas':
                $rutaAnterior = 'cirugias.index';
                break;

            // Quirófanos
            case 'quirofanos.create':
            case 'quirofanos.edit':
            case 'quirofanos.show':
                $rutaAnterior = 'quirofanos.index';
                break;

            // Por defecto
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
