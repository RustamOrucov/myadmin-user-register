<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('privacies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('privacy_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('privacy_id')->references('id')->on('privacies')->onDelete('cascade');
            $table->string('text', 1000)->nullable();
            $table->string('locale')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacies');
        Schema::dropIfExists('privacy_translations');
    }
};
