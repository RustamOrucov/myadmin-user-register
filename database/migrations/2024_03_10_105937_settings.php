<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo',300)->nullable();
            $table->string('favicon',300)->nullable();
            $table->timestamps();
        });

        Schema::create('settings_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('settings_id')->references('id')->on('settings')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('text', 500)->nullable();
            $table->text('seo_key')->nullable();
            $table->text('title',400)->nullable();
            $table->string('locale')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('settings_translations');
    }
};
