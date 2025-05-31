<div class="form-group">
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $alumno->nombre ?? '') }}">
</div>

<div class="form-group">
    <label>Apellido</label>
    <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $alumno->apellido ?? '') }}">
</div>

<div class="form-group">
    <label>DNI</label>
    <input type="text" name="dni" class="form-control" value="{{ old('dni', $alumno->dni ?? '') }}">
</div>

<div class="form-group">
    <label>Fecha de Nacimiento</label>
    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento ?? '') }}">
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $alumno->email ?? '') }}">
</div>

<div class="form-group">
    <label>Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $alumno->telefono ?? '') }}">
</div>

<div class="form-group">
    <label>Domicilio</label>
    <input type="text" name="domicilio" class="form-control" value="{{ old('domicilio', $alumno->domicilio ?? '') }}">
</div>

