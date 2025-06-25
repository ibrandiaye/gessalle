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
            $table->unsignedBigInteger("plan_id");
            $table->foreign("plan_id")
            ->references("id")
            ->on("plans");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('licences', callback: function (Blueprint $table) {
            $table->dropForeign("licences_plan_id_foreign");
            $table->dropColumn("plan_id");
        });
    }
};
