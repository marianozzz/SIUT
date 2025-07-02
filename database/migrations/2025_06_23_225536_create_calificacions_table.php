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
        Schema::create('calificacions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('alumno_id')->constrained()->onDelete('cascade');
                $table->foreignId('curso_id')->constrained()->onDelete('cascade');
                $table->foreignId('asignatura_id')->nullable()->constrained()->onDelete('cascade');
                $table->float('nota');
                $table->string('descripcion')->nullable();
                $table->date('fecha')->nullable();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacions');
    }
};
