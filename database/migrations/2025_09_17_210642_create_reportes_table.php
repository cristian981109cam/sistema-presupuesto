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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->foreignId('id_mes')->constrained('meses'); // FK a meses
            $table->foreignId('id_presupuesto')->constrained('presupuestos');
            $table->decimal('ingresos', 15, 2)->default(0);
            $table->decimal('gastos', 15, 2)->default(0);
            $table->decimal('disponible', 15, 2)->default(0);
            $table->string('aviso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
