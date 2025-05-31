<div class="mb-3">
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $alumno->nombre) }}">
</div>

<div class="mb-3">
    <label>Apellido</label>
    <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $alumno->apellido) }}">
</div>

<div class="mb-3">
    <label>Año</label>
    <input type="number" name="año" class="form-control" value="{{ old('año', $alumno->año) }}">
</div>

<div class="mb-3">
    <label>División</label>
    <input type="text" name="division" class="form-control" value="{{ old('division', $alumno->division) }}">
</div>

<div class="mb-3">
    <label>Turno</label>
    <select name="turno" class="form-control">
        <option value="Mañana" {{ old('turno', $alumno->turno) == 'Mañana' ? 'selected' : '' }}>Mañana</option>
        <option value="Tarde" {{ old('turno', $alumno->turno) == 'Tarde' ? 'selected' : '' }}>Tarde</option>
        <option value="Noche" {{ old('turno', $alumno->turno) == 'Noche' ? 'selected' : '' }}>Noche</option>
    </select>
</div>
