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
        Schema::table('licences', function (Blueprint $table) {
             $table->enum("statut",['active','expire','paiement_en_cours'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('licences', function (Blueprint $table) {
             $table->enum("statut",['active','expire']);
        });
    }
};
