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
        Schema::create('reservation_children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')
                ->constrained('children')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('reservation_id')
                ->constrained('reservations')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_children');
    }
};
