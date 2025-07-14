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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string("libelle");
            $table->date("date_depense");
            $table->double("montant");
            $table->unsignedBigInteger("salle_id");
            $table->foreign("salle_id")
            ->references("id")
            ->on("salles");
            $table->unsignedBigInteger("employe_id")->nullable();
            $table->foreign("employe_id")
            ->references("id")
            ->on("employes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
