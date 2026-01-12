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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nome');
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->string('sku');
            $table->string('categoria');
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2);
            $table->decimal('preco_promocional', 10, 2);
            $table->integer('stock')->default(0);
            $table->boolean('activo')->default(true);
            $table->string('imagem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
