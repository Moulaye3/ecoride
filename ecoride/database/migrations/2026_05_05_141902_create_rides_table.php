<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('rides', function (Blueprint $table) {
        $table->id();
        $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('vehicle_id')->nullable()->constrained()->onDelete('set null');
        
        $table->string('departure_city');
        $table->string('arrival_city');
        $table->text('departure_address')->nullable();
        $table->text('arrival_address')->nullable();
        
        // ✅ Utilise dateTime au lieu de timestamp (plus stable sur MySQL)
        $table->dateTime('departure_datetime');
        $table->dateTime('arrival_datetime');
        
        $table->decimal('price', 8, 2);
        $table->integer('seats_available');
        
        $table->enum('status', ['pending', 'ongoing', 'completed', 'cancelled'])
              ->default('pending');
        
        $table->timestamps();

        $table->index(['departure_city', 'departure_datetime']);
    });
}
};
