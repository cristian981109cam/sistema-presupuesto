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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_categoria')
                  ->constrained('categorias')
                  ->onDelete('cascade');
            $table->foreignId('id_ingreso_gasto')
                  ->constrained('ingresos_gastos');
            $table->decimal('monto', 15, 2);
            $table->string('nota')->nullable();
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
