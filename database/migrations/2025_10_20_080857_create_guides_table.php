<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    function up(): void
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedSmallInteger('experience_years');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    function down(): void
    {
        Schema::dropIfExists('guides');
    }
};
