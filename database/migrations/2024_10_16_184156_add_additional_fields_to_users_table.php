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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf')->unique(); // CPF (com restrição de unicidade)
            $table->date('birthdate'); // Data de nascimento
            $table->string('phone'); // Telefone
            $table->string('address');
            $table->string('password')->nullable()->change(); // Endereço
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cpf', 'birthdate', 'phone', 'address']);
        });
    }
};
