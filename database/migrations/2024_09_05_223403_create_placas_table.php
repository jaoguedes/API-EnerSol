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
        Schema::create('placas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('valor', 8, 2);
            $table->float('potencia');
            $table->integer('tamanho');
            $table->integer('quantidade');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placas');
    }
};
