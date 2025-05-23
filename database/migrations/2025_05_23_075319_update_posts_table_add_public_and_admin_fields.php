<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Make location_id nullable if it's no longer strictly required
            $table->foreignId('location_id')->nullable()->change();

            // Public form fields
            $table->string('location')->nullable()->after('status'); // plain text location
            $table->decimal('latitude', 10, 7)->nullable()->after('location');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->string('contact_name')->after('price');
            $table->string('email')->after('contact_name');
            $table->string('phone')->after('email');
            $table->string('tags')->nullable()->after('phone');

            // Admin controls
            $table->boolean('is_featured')->default(false)->after('tags');
            $table->enum('admin_status', ['approved', 'pending', 'rejected'])->default('pending')->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'location',
                'latitude',
                'longitude',
                'contact_name',
                'email',
                'phone',
                'tags',
                'is_featured',
                'admin_status',
            ]);
        });
    }
};
