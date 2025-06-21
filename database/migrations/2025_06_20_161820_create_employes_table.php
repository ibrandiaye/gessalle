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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string("pseudo");

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")
            ->references("id")
            ->on("users");
             $table->unsignedBigInteger("salle_id");
            $table->foreign("salle_id")
            ->references("id")
            ->on("salles");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
