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
        Schema::create("device_costs", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users");
            $table->foreignId("device_id")->references("id")->on("devices");
            $table->float("kw_cost_per_hour")->nullable(false);
            $table->float("kw_cost")->nullable(false);
            $table->float("total_kw_consumed")->nullable(false);
            $table->timestamp("from")->nullable(false);
            $table->timestamp("to")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("device_costs", function (Blueprint $table) {
            $table->dropForeign("user_id");
            $table->dropForeign("device_id");
        });

        Schema::dropIfExists("device_costs");
    }
};
