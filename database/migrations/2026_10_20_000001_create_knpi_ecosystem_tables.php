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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 2. Articles
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->longText('content');
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // 3. Events
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('location');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('quota')->default(100);
            $table->string('banner_image')->nullable();
            $table->boolean('is_open_registration')->default(true);
            $table->timestamps();
        });

        // 4. Event Registrations
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('name');
            $table->string('nik', 16);
            $table->string('email');
            $table->string('phone');
            $table->string('okp_origin'); // Nama OKP atau Umum
            $table->enum('status', ['registered', 'attended', 'canceled'])->default('registered');
            $table->timestamps();
        });

        // 5. Organizations (OKP)
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama OKP
            $table->string('slug')->unique();
            $table->string('leader_name'); // Ketua Umum
            $table->string('email');
            $table->string('phone');
            $table->string('sk_number'); // Nomor SK Legalitas
            $table->string('sk_file')->nullable(); // PDF SK Kemenkumham/DPD
            $table->date('period_start')->nullable();
            $table->date('period_end')->nullable();
            $table->enum('status', ['pending', 'verified', 'expired'])->default('pending');
            $table->timestamps();
        });

        // 6. Gallery Albums
        Schema::create('gallery_albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });

        // 7. Gallery Items
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_album_id')->constrained('gallery_albums')->cascadeOnDelete();
            $table->enum('type', ['photo', 'video'])->default('photo');
            $table->string('file_path');
            $table->string('caption')->nullable();
            $table->timestamps();
        });

        // 8. Aspirations
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code')->unique(); // KNPI-YYYYMM-XXXX
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('category'); // Pendidikan, Ketenagakerjaan, Kepemudaan, Hukum/Umum
            $table->string('subject');
            $table->text('message');
            $table->enum('status', ['submitted', 'in_review', 'resolved'])->default('submitted');
            $table->text('admin_notes')->nullable();
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('attachment')->nullable();
            $table->timestamps();
        });

        // 9. Officials
        Schema::create('officials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position'); // Ketua/Sekjen/Bendahara
            $table->string('department');
            $table->string('photo')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officials');
        Schema::dropIfExists('aspirations');
        Schema::dropIfExists('gallery_items');
        Schema::dropIfExists('gallery_albums');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('events');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('categories');
    }
};
