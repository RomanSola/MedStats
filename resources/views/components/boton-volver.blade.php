<div class="container mt-2">
    @php
        $rutaActual = request()->route()->getName();

        // Detectamos si viene de la búsqueda
        $fromBusqueda = request()->query('from') === 'busqueda';
        $pacienteId = request()->query('id'); // capturamos el paciente abierto, si está

        if ($fromBusqueda && $pacienteId) {
            // Redirige a la vista de resultados con el paciente abierto
            $rutaAnterior = route('persona.ver', ['id' => $pacienteId, 'from' => 'busqueda']);
        } else {
            // Lógica original
            switch ($rutaActual) {
                case 'stocks.index':
                case 'pacientes.index':
                case 'estadisticas':
                case 'camas.index':
                case 'cirugias.estadisticas':
                case 'ajustes':
                    $rutaAnterior = route('inicio');
                    break;

                case 'usuarios.index':
                case 'medicamentos.index':
                case 'UsuarioPerfil.index':
                case 'empleados.index':
                case 'salas.index':
                case 'habitaciones.index':
                case 'quirofanos.index':
                case 'procedimientos.index':
                case 'profesion.index':
                case 'tipoAnestesias.index':
                case 'ocupacionCamas.index':
                case 'perfiles.index':
                    $rutaAnterior = route('ajustes');
                    break;

                case 'perfiles.create':
                case 'perfiles.edit':
                    $rutaAnterior = route('perfiles.index');
                    break;

                case 'profesion.create':
                case 'profesion.edit':
                case 'profesion.show':
                    $rutaAnterior = route('profesion.index');
                    break;

                case 'procedimientos.create':
                case 'procedimientos.edit':
                case 'procedimientos.show':
                    $rutaAnterior = route('procedimientos.index');
                    break;

                case 'camas.create':
                case 'camas.edit':
                case 'camas.show':
                    $rutaAnterior = route('camas.index');
                    break;

                case 'empleados.create':
                case 'empleados.edit':
                case 'empleados.show':
                    $rutaAnterior = route('empleados.index');
                    break;

                case 'stocks.create':
                case 'stocks.edit':
                case 'stocks.show':
                    $rutaAnterior = route('stocks.index');
                    break;

                case 'tipoAnestesias.create':
                case 'tipoAnestesias.edit':
                    $rutaAnterior = route('tipoAnestesias.index');
                    break;

                case 'pacientes.create':
                case 'pacientes.edit':
                case 'pacientes.show':
                case 'pacientes.asignar':
                    $rutaAnterior = route('pacientes.index');
                    break;

                case 'ocupacionCamas.create':
                case 'ocupacionCamas.edit':
                case 'ocupacionCamas.show':
                case 'ocupacionCamas.darAlta':
                    $rutaAnterior = route('ocupacionCamas.index');
                    break;

                case 'medicamentos.create':
                case 'medicamentos.edit':
                    $rutaAnterior = route('medicamentos.index');
                    break;

                case 'usuarios.create':
                case 'usuarios.edit':
                case 'usuarios.show':
                    $rutaAnterior = route('usuarios.index');
                    break;

                case 'habitaciones.create':
                case 'habitaciones.edit':
                    $rutaAnterior = route('habitaciones.index');
                    break;

                case 'UsuarioPerfil.create':
                case 'UsuarioPerfil.edit':
                    $rutaAnterior = route('UsuarioPerfil.index');
                    break;

                case 'salas.create':
                case 'salas.edit':
                    $rutaAnterior = route('salas.index');
                    break;

                case 'cirugias.create':
                case 'cirugias.edit':
                case 'cirugias.show':
                    $rutaAnterior = route('cirugias.index');
                    break;

                case 'quirofanos.create':
                case 'quirofanos.edit':
                case 'quirofanos.show':
                    $rutaAnterior = route('quirofanos.index');
                    break;

                default:
                    $rutaAnterior = route('inicio');
                    break;
            }
        }
    @endphp

    @if ($rutaActual !== 'inicio')
        <a href="{{ $rutaAnterior }}" class="btn btn-outline-secondary btn-sm btn-volver-fijo" title="Volver">
            🡐
        </a>
    @endif
</div>

<style>
    .btn-volver-fijo {
        position: fixed;
        top: 70px;
        left: 7px;
        z-index: 9999;
        font-size: 1.2rem;

        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        padding: 18px 22px;
    }

    .btn-volver-fijo:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .btn-volver-fijo {
            bottom: 100px;
            left: 10px;
            font-size: 13px;
            padding: 5px 12px;
        }
    }
</style>
