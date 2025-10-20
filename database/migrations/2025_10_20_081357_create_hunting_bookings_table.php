<?php

use App\Models\Guide;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    function up(): void
    {
        Schema::create('hunting_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('tour_name');
            $table->string('hunter_name');
            $table->foreignIdFor(Guide::class)->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->date('date');
            $table->unsignedSmallInteger('participants_count');
            $table->timestamps();
        });
    }

    function down(): void
    {
        Schema::dropIfExists('hunting_bookings');
    }
};
