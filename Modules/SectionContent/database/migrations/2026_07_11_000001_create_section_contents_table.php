<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique();
            $table->string('badge_text')->nullable();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_contents');
    }
};