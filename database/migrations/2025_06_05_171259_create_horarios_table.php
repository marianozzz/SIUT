<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();

            // Relación con asignatura_curso
            $table->foreignId('asignatura_curso_id')->constrained()->onDelete('cascade');

            // Día y horario
            $table->string('dia'); // Ej: Lunes, Martes...
            $table->time('hora_entrada');
            $table->time('hora_salida');

            // Relación con turno
            $table->foreignId('turno_id')->nullable()->constrained('turnos')->onDelete('set null');

            // Nuevo: Relación con docente
            $table->foreignId('profesor_id')->nullable()->constrained('docentes')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
