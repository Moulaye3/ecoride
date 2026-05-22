<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('ride_id')->constrained()->onDelete('cascade');
        $table->foreignId('reviewer_id')->constrained('users');
        $table->foreignId('driver_id')->constrained('users');
        $table->tinyInteger('rating')->check('rating between 1 and 5');
        $table->text('comment')->nullable();
        $table->enum('status', ['pending', 'validated', 'refused'])->default('pending');
        $table->timestamps();
    });
}
};
