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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // User who receives the notification
            $table->foreignId('notifiable_id'); // The ID of the object (e.g., post or user)
            $table->string('notifiable_type'); // The type of the object (e.g., Post, User)
            $table->string('type'); // Type of notification (like, comment, follow)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};