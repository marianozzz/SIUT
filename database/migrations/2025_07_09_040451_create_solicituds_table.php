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
        Schema::create('solicitudes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tipo_solicitud_id')->constrained('tipo_solicitudes');
                $table->foreignId('alumno_id')->nullable()->constrained()->onDelete('cascade');
                $table->foreignId('docente_id')->nullable()->constrained()->onDelete('cascade');
                $table->text('motivo');
                $table->enum('estado', ['pendiente', 'aprobada', 'rechazada'])->default('pendiente');
                $table->text('respuesta')->nullable();
                $table->string('archivo')->nullable(); // ruta del archivo
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};
