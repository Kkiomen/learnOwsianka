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
            $table->bigInteger('social_post_id')->unsigned();
            $table->text('slug');
            $table->text('title');
            $table->text('short_description');
            $table->string('language');
            $table->text('content')->nullable();
            $table->text('tags')->nullable();
            $table->text('image_url')->nullable();
            $table->boolean('activated')->default(false);
            $table->timestamps();
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
