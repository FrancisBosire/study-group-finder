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
        // Prevent error if table already exists
        if (!Schema::hasTable('project_request_likes')) {
            Schema::create('project_request_likes', function (Blueprint $table) {
                $table->id();

                // User who liked
                $table->foreignId('user_id')
                      ->constrained()
                      ->onDelete('cascade');

                // Project Request liked
                $table->foreignId('project_request_id')
                      ->constrained()
                      ->onDelete('cascade');

                // Prevent duplicate likes from same user
                $table->unique(['user_id', 'project_request_id']);

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop if exists
        if (Schema::hasTable('project_request_likes')) {
            Schema::dropIfExists('project_request_likes');
        }
    }
};
