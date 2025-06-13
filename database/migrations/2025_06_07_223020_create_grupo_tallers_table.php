<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('grupo_talleres', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // A, B, etc.
            $table->foreignId('asignatura_curso_id')->nullable()->constrained()->onDelete('cascade');
            // $table->foreignId('docente_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grupo_talleres');
    }
};
