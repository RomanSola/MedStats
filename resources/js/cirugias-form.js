class CirugiaForm {
    constructor() {
        this.oldEspecialidadId = document.getElementById('cirugia-form')?.dataset.oldEspecialidad || '';
        this.oldProcedimientoId = document.getElementById('cirugia-form')?.dataset.oldProcedimiento || '';
        this.oldProcedimiento2Id = document.getElementById('cirugia-form')?.dataset.oldProcedimiento2 || '';
        
        this.init();
    }

    init() {
        this.initializeSelect2();
        this.setupEventListeners();
        this.restoreOldValues();
    }

    initializeSelect2() {
        $('.select2').select2({
            placeholder: "Seleccione una opción",
            allowClear: true,
            width: '100%'
        });
    }

    setupEventListeners() {
        // Cambio de especialidad
        $('#especialidad').on('change', (e) => this.handleEspecialidadChange(e.target.value));
        
        // Validación de duración
        $('#duracion_horas, #duracion_minutos').on('change', () => this.validateDuration());
        
        // Prevenir envío duplicado
        $('#cirugia-form').on('submit', (e) => this.handleFormSubmit(e));
    }

    async handleEspecialidadChange(especialidadId) {
        if (especialidadId) {
            await Promise.all([
                this.cargarProcedimientos(especialidadId, this.oldProcedimientoId, '#procedimiento'),
                this.cargarProcedimientos(especialidadId, this.oldProcedimiento2Id, '#procedimiento2')
            ]);
        } else {
            this.clearProcedimientos();
        }
    }

    async cargarProcedimientos(especialidadId, selectedId, selector) {
        try {
            const response = await fetch(`/medstats-api/procedimientos/${especialidadId}`);
            const data = await response.json();
            
            const select = $(selector);
            select.html('<option value="">Seleccione un procedimiento</option>');

            data.forEach(procedimiento => {
                const selected = selectedId == procedimiento.id ? 'selected' : '';
                select.append(
                    `<option value="${procedimiento.id}" ${selected}>${procedimiento.nombre_procedimiento}</option>`
                );
            });
        } catch (error) {
            console.error('Error cargando procedimientos:', error);
            this.showError('Error al cargar los procedimientos');
        }
    }

    clearProcedimientos() {
        $('#procedimiento, #procedimiento2').html('<option value="">Seleccione un procedimiento</option>');
    }

    validateDuration() {
        const horas = parseInt($('#duracion_horas').val()) || 0;
        const minutos = parseInt($('#duracion_minutos').val()) || 0;

        if (minutos > 59) {
            $('#duracion_minutos').val(59);
            this.showError('Los minutos no pueden ser mayores a 59');
        }

        if (horas < 0) $('#duracion_horas').val(0);
        if (minutos < 0) $('#duracion_minutos').val(0);
    }

    handleFormSubmit(e) {
        const submitBtn = e.target.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Registrando...';
        
        // Re-habilitar después de 3 segundos por si hay error
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Registrar Cirugía';
        }, 3000);
    }

    restoreOldValues() {
        if (this.oldEspecialidadId) {
            $('#especialidad').val(this.oldEspecialidadId).trigger('change');
        }
    }

    showError(message) {
        // Implementar notificación de error
        console.error(message);
    }
}

// Inicializar cuando el documento esté listo
document.addEventListener('DOMContentLoaded', function() {
    new CirugiaForm();
});