<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->date('start_date'); 
            $table->date('end_date'); 
            $table->time('time'); 
            $table->text('description')->nullable();
            $table->string('location')->nullable(); 
            $table->foreignId('type_event_id')->constrained('event_types')->onDelete('cascade'); // Chave estrangeira
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

