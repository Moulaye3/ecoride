<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('preferences', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
        $table->boolean('no_smoking')->default(true);
        $table->boolean('no_animals')->default(false);
        $table->tinyInteger('music_level')->default(2)->check('music_level between 0 and 3');
        $table->json('other_preferences')->nullable();
        $table->timestamps();
    });
}
};
