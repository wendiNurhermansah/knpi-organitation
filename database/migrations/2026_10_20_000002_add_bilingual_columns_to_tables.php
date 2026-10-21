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
        // 1. Categories
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
        });

        // 2. Articles
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('summary_en')->nullable()->after('summary');
            $table->longText('content_en')->nullable()->after('content');
        });

        // 3. Events
        Schema::table('events', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
            $table->string('location_en')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en', 'location_en']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'summary_en', 'content_en']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['name_en']);
        });
    }
};
