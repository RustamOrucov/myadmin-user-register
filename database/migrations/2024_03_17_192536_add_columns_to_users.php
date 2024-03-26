<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new  class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->text('surname')->nullable()->after('name');
            $table->text('about')->nullable()->after('surname');
            $table->text('img')->nullable()->after('about');
            $table->string('prefix')->nullable()->after('img');
            $table->text('phone')->nullable()->after('prefix');
            $table->text('status')->default('0')->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
