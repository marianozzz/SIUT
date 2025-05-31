{{-- resources/views/admin/especialidades/partials/form.blade.php --}}
<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $especialidad->nombre ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control">{{ old('descripcion', $especialidad->descripcion ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('admin.especialidades.index') }}" class="btn btn-secondary">Cancelar</a>

