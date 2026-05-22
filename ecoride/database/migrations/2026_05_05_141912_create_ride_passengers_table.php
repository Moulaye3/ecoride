<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('ride_passengers', function (Blueprint $table) {
        $table->foreignId('ride_id')->constrained()->onDelete('cascade');
        $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
        $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('confirmed');
        $table->timestamp('joined_at')->useCurrent();
        $table->primary(['ride_id', 'passenger_id']);
    });
}
};
