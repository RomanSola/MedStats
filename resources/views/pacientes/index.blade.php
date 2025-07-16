@extends('layouts.app')

@section('titulo', 'Gestión de Pacientes')

@section('contenido')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Pacientes Registrados</h1>
        <a href="{{ route('pacientes.create') }}"
           class="bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow">
            + Ingresar Nuevo Paciente
        </a>
    </div>

    <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
        <table class="min-w-full text-sm text-gray-800 table-auto">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-2 border">DNI</th>
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Apellido</th>
                    <th class="px-4 py-2 border">Teléfono</th>
                    <th class="px-4 py-2 border">Género</th>
                    <th class="px-4 py-2 border">Habitación</th>
                    <th class="px-4 py-2 border">Cama</th>
                    <th class="px-4 py-2 border text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pacientes as $paciente)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $paciente->dni }}</td>
                    <td class="px-4 py-2 border">{{ $paciente->nombre }}</td>
                    <td class="px-4 py-2 border">{{ $paciente->apellido }}</td>
                    <td class="px-4 py-2 border">{{ $paciente->telefono }}</td>
                    <td class="px-4 py-2 border">{{ $paciente->genero }}</td>
                    <td class="px-4 py-2 border">{{ $paciente->habitacion?->numero ?? '—' }}</td>
                    <td class="px-4 py-2 border">{{ $paciente->cama?->codigo ?? '—' }}</td>
                    <td class="px-4 py-2 border text-center space-x-2">
                        <a href="{{ route('pacientes.show', $paciente) }}" class="text-neutral-700 hover:underline font-medium">Ver</a>
                        <a href="{{ route('pacientes.edit', $paciente) }}" class="text-neutral-700 hover:underline font-medium">Editar</a>
                        @if($paciente->cama_id)
                        <form action="{{ route('pacientes.darDeAlta', $paciente) }}" method="POST" class="inline-block form-dar-de-alta">
                            @csrf
                            <button type="submit" class="text-green-600 hover:underline font-medium">Dar de alta</button>
                        </form>
                        @else
                        <form action="{{ route('pacientes.asignar', $paciente) }}" method="GET" class="inline-block form-asignar">
                            <button type="submit" class="text-blue-700 hover:underline font-medium">Asignar</button>
                        </form>
                        @endif
                        <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" class="inline-block form-eliminar">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline font-medium">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-2 text-center text-gray-500">No hay pacientes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL DE CONFIRMACIÓN PERSONALIZADO -->
<div id="modal-confirmacion" class="modal">
    <div class="modal-content">
        <p id="modal-mensaje">¿Estás seguro?</p>
        <div class="botones">
            <button id="modal-cancelar">Cancelar</button>
            <button id="modal-confirmar">Confirmar</button>
        </div>
    </div>
</div>

<!-- ESTILOS DEL MODAL -->
<style>
.modal {
    display: none;
    position: fixed;
    z-index: 50;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}
.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.25);
}
.botones {
    margin-top: 20px;
    display: flex;
    justify-content: space-around;
}
.botones button {
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
#modal-cancelar {
    background-color: #ccc;
    color: #333;
}
#modal-confirmar {
    background-color: #d9534f;
    color: white;
}
</style>

<!-- SCRIPT PARA MANEJAR LOS MODALES -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal-confirmacion');
    const mensaje = document.getElementById('modal-mensaje');
    const btnCancelar = document.getElementById('modal-cancelar');
    const btnConfirmar = document.getElementById('modal-confirmar');

    let formularioActual = null;

    // Abre el modal con el mensaje deseado y referencia al formulario
    function abrirModal(texto, form) {
        mensaje.textContent = texto;
        formularioActual = form;
        modal.style.display = 'block';
    }

    // Cierra el modal si el usuario cancela
    btnCancelar.addEventListener('click', () => {
        modal.style.display = 'none';
        formularioActual = null;
    });

    // Envía el formulario si el usuario confirma
    btnConfirmar.addEventListener('click', () => {
        if (formularioActual) formularioActual.submit();
    });

    // CONFIRMACIÓN PARA DAR DE ALTA
    document.querySelectorAll('.form-dar-de-alta').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            abrirModal('¿Estás seguro que querés dar de alta a este paciente? Esta acción liberará la cama asignada.', form);
        });
    });

    // CONFIRMACIÓN PARA ELIMINAR
    document.querySelectorAll('.form-eliminar').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            abrirModal('¿Seguro que querés eliminar este paciente? Esta acción no se puede deshacer.', form);
        });
    });

    // CONFIRMACIÓN PARA ASIGNAR
    document.querySelectorAll('.form-asignar').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            abrirModal('¿Querés asignar una cama a este paciente?', form);
        });
    });

    // Cierra el modal si se hace clic fuera del contenido
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            formularioActual = null;
        }
    };
});
</script>
@endsection
