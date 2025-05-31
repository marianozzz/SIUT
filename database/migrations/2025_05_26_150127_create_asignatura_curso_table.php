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
        Schema::create('asignatura_curso', function (Blueprint $table) {
            $table->id();
            $table->text('tema')->nullable(); // Tema específico para el curso
            $table->unsignedBigInteger('profesor_id')->nullable();
           
            $table->foreignId('curso_id')->constrained()->onDelete('cascade');
            $table->foreignId('asignatura_id')->constrained()->onDelete('cascade');
            $table->foreign('profesor_id')->references('id')->on('Docentes')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignatura_curso');
    }
};
