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
            // Adiciona a coluna 'inicio_almoco' DEPOIS da coluna 'password'
            $table->dateTime('inicio_almoco')->nullable()->after('password');
            
            // Adiciona a coluna 'state' DEPOIS de 'inicio_almoco'
            $table->enum('state', ['active', 'inactive'])->default('active')->after('inicio_almoco');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Se fizermos rollback, removemos estas colunas
            $table->dropColumn(['inicio_almoco', 'state']);
        });
    }
};