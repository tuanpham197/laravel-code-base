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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('family_group_id')->constrained('family_groups')->onDelete('cascade');
            $table->string('name');
            $table->string('type'); // real_estate, vehicle, investment, retirement, crypto, other
            $table->decimal('value', 15, 2);
            $table->text('description')->nullable();
            $table->timestamp('purchase_date');
            $table->decimal('purchase_price', 15, 2);
            $table->string('location')->nullable();
            $table->string('status')->default('active'); // active, sold, depreciated
            $table->decimal('appreciation_rate', 5, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
