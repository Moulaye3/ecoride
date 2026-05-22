<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('brand');
        $table->string('model');
        $table->string('color')->nullable();
        $table->enum('energy', ['electric', 'hybrid', 'thermal']);
        $table->string('plate')->unique();
        $table->date('first_registration_date')->nullable();
        $table->unsignedTinyInteger('seats')->check('seats between 1 and 9');
        $table->timestamps();
    });
}
};
