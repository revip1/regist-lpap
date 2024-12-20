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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->string('full_name');
            $table->string('whatsapp_number');
            $table->string('email');
            $table->text('address');
            $table->string('occupation');
            $table->string('institution');
            $table->string('training_ticket');
            $table->text('reason_to_join')->nullable();
            $table->string('information_source')->nullable();
            $table->string('referral')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
