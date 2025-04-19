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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('goal');
            $table->string('place');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('signature_date');
            $table->string('travel')->nullable();
            $table->string('sponsore')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('missions_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_id')->constrained()->onDelete('cascade');
            $table->foreignId('people_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
        Schema::dropIfExists('missions_people');
    }
};
