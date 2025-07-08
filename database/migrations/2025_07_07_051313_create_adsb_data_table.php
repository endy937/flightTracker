<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('adsb_data', function (Blueprint $table) {
            $table->id();
            $table->string('callsign')->nullable();
            $table->double('lat', 10, 6);
            $table->double('lon', 10, 6);
            $table->integer('altitude')->nullable();
            $table->integer('speed')->nullable();
            $table->integer('heading')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adsb_data');
    }
};
