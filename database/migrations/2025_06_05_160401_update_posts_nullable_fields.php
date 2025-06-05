<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsNullableFields extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Make contact_name and email nullable
            $table->string('contact_name')->nullable()->change();
            $table->string('email')->nullable()->change();

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Revert to NOT nullable for contact_name and email
            $table->string('contact_name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();

           
        });
    }
}
