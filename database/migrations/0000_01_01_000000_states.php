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
        Schema::create("states", function (Blueprint $table) {
            $table->id();
            $table->string("state_name")->nullable(false);
            $table->string("state_acronym")->nullable(false);
            $table->float("kiloWh_hour")->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("states");
    }
};
