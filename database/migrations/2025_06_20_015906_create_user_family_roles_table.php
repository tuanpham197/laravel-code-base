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
        Schema::create('user_family_roles', function (Blueprint $table) {
            $table->id('user_family_role_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('family_group_id')->constrained('family_groups')->onDelete('cascade');
            $table->enum('role', ['owner', 'member', 'viewer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_family_roles');
    }
};
