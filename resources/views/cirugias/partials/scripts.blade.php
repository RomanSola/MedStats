<!-- Dependencias -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Script principal -->
<script src="{{ asset('js/cirugias-form.js') }}"></script>

<!-- Pasar datos old al JS -->
<script>
    document.getElementById('cirugia-form').dataset.oldEspecialidad = "{{ old('especialidad_id') }}";
    document.getElementById('cirugia-form').dataset.oldProcedimiento = "{{ old('procedimiento_id') }}";
    document.getElementById('cirugia-form').dataset.oldProcedimiento2 = "{{ old('procedimiento_2_id') }}";
</script>