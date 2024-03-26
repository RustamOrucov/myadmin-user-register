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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('img',300)->nullable();
            $table->boolean('status');
            $table->boolean('f_status');
            $table->boolean('order')->default(0)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name', 80);
            $table->string('slug')->nullable();
            $table->text('desc')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_desc')->nullable();
            $table->text('seo_key')->nullable();
            $table->string('locale')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_translations');
    }
};
