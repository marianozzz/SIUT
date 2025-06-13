<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alumno_grupo_taller', function (Blueprint $table) {
            $table->id();

            $table->foreignId('alumno_id')->constrained()->onDelete('cascade');

            // 👇 Especificamos correctamente el nombre de la tabla de destino
            $table->unsignedBigInteger('grupo_taller_id');
            $table->foreign('grupo_taller_id')->references('id')->on('grupo_talleres')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumno_grupo_taller');
    }
};
