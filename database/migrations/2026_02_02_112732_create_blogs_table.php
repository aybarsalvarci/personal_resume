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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('image');
            $table->string('title');
            $table->string('slug');
            $table->enum('status', ['published', 'draft'])->default('draft');
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->text('content');
            $table->boolean('isFeatured')->default(false);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('blog_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
