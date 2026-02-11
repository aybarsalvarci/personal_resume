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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('meta_keywords');
            $table->string('meta_description');
            $table->string('meta_author');

            $table->string('title');

            //logo
            $table->string('logo_light');
            $table->string('logo_dark');

            //favicon
            $table->string('favicon');
            $table->string('favicon32x32');
            $table->string('favicon16x16');
            $table->string('apple_touch_icon');
            $table->string('manifest');
            $table->string('mask_icon');
            $table->string('browser_config');


            // social media
            $table->string('github');
            $table->string('twitter');
            $table->string('linkedin');
            $table->string('instagram');
            $table->string('email');

            //
            $table->string('address');
            $table->string('working_hours');

            $table->string('footer_description');
            $table->string('footer_text');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
