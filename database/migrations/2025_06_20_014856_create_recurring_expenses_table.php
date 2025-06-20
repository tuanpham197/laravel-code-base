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
        Schema::create('recurring_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('family_group_id')->constrained('family_groups')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->decimal('amount', 15, 2);
            $table->string('frequency'); // daily, weekly, monthly, yearly
            $table->text('description')->nullable();
            $table->timestamp('start_date');
            $table->timestamp('next_due_date');
            $table->timestamp('end_date')->nullable();
            $table->string('status')->default('active');
            $table->boolean('auto_pay')->default(false);
            $table->integer('reminder_days')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_expenses');
    }
};
