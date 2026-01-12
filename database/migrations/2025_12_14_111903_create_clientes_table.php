<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->enum('tipo', ['PF', 'PJ'])->default('PF');

            $table->string('documento')->nullable();
            $table->string('empresa')->nullable();

            $table->text('endereco')->nullable();
            $table->boolean('ativo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

