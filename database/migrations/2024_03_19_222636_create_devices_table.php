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
        Schema::create('devices', function (Blueprint $table) {
            $table->uuid();
            $table->foreignUuid("user_uuid")->references("uuid")->on("users");
            $table->integer("consumptionPerHour")->nullable(false);
            $table->string("brand", 100)->nullable(false);
            $table->string("name", 160)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("devices", function (Blueprint $table) {
            $table->dropForeign("user_uuid");
        });
        Schema::dropIfExists('devices');
    }
};
