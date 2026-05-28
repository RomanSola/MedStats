
        document.addEventListener('DOMContentLoaded', function() {
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
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    abrirModal(
                        '¿Estás seguro que querés dar de alta a este paciente? Esta acción liberará la cama asignada.',
                        form);
                });
            });

            // CONFIRMACIÓN PARA ELIMINAR
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    abrirModal(
                        '¿Seguro que querés eliminar este paciente? Esta acción no se puede deshacer.',
                        form);
                });
            });

            // CONFIRMACIÓN PARA ASIGNAR
            document.querySelectorAll('.form-asignar').forEach(form => {
                form.addEventListener('submit', function(e) {
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
