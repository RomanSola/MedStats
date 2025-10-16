{{--
SE MOVIÓ A LAYOUTS -> _PARTIALS -> SIDEBAR.BLADE

<div class="container mt-2">
    @php
        $rutaActual = request()->route()->getName();

        switch ($rutaActual) {
            // Rutas que vuelven al inicio
            case 'stocks.index':
            case 'pacientes.index':
            case 'estadisticas':
            case 'camas.index':
            case 'cirugias.estadisticas':
            //case 'cirugias.index':
            case 'ajustes':
                $rutaAnterior = 'inicio';
                break;

            // Rutas que vuelven a Ajustes
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
            case 'especialidades.index':
                $rutaAnterior = 'ajustes';
                break;

            //Perfiles
            case 'perfiles.create':
            case 'perfiles.edit':
                $rutaAnterior = 'perfiles.index';
                break;

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
                // case 'cirugias.estadisticas':
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
        <form action="{{ route($rutaAnterior) }}" method="GET">
            <button type="submit" class="btn btn-outline-secondary btn-sm btn-volver-fijo" title="Volver">
                🡐
            </button>
        </form>
    @endif

    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>

<style>

.btn-volver-fijo {
    position: fixed;
    top: 80px;
    left: 5rem; /* ubicación constante junto al sidebar */
    z-index: 9999;
    font-size: 1.2rem;
    border-radius: 50px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    padding: 18px 22px;
    background-color: white;
    border: 1px solid #ccc;
}

/* Hover efecto */
.btn-volver-fijo:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

/* 📱 Media queries solo para estilo visual */
@media (max-width: 1024px) {
    .btn-volver-fijo {
        font-size: 1rem;
        padding: 14px 18px;
    }
}

@media (max-width: 640px) {
    .btn-volver-fijo {
        font-size: 0.9rem;
        padding: 12px 16px;
    }
}

@media (max-width: 480px) {
    .btn-volver-fijo {
        font-size: 0.85rem;
        padding: 10px 14px;
    }
}
</style>

<!--<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById('sidebar');
        const botonVolver = document.querySelector('.btn-volver-fijo');
        const toggleBtn = document.getElementById('toggleSidebar');

        function ajustarBotonVolver() {
            if (sidebar.classList.contains('w-64')) {
                botonVolver.style.left = '16rem'; // sidebar expandido
            } else {
                botonVolver.style.left = '5rem'; // sidebar colapsado
            }
        }

        // Ajustar al cargar
        ajustarBotonVolver();

        // Ajustar al hacer toggle
        toggleBtn.addEventListener('click', () => {
            setTimeout(ajustarBotonVolver, 300); // esperar transición
        });
    });
</script>-->
--}}