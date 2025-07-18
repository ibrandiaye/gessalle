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
              $table->unsignedBigInteger("salle_id")->nullable();
            $table->foreign("salle_id")
            ->references("id")
            ->on("salles");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign("users_salle_id_foreign");
            $table->dropColumn("salle_id");
        });
    }
};
