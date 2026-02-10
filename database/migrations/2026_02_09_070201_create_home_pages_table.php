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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_badge');
            $table->string('hero_title');
            $table->string('hero_subtitle');
            $table->string('hero_description');
            $table->json('hero_terminal');
            $table->json('stats');
            $table->json("about");
            $table->json("techs");
            $table->json('principles');
            $table->json('setup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
