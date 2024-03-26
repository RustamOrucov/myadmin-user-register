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
            $table->boolean('status');
            $table->integer('view_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->string('img',300)->nullable();
            $table->dateTime('publish_date')->default(now());
            $table->integer('read_time')->default(0);
            $table->string('order')->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('blog_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->string('name', 80);
            $table->string('slug');
            $table->text('text')->nullable();
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
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_translations');
    }
};
