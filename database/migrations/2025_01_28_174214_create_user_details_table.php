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
            $table->string('name');
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->string('instance');
            $table->string('email');
            $table->text('address');
            $table->enum('identity_type', ['KTP', 'SIM', 'KP',])->nullable();
            $table->string('identity_number')->nullable();
            $table->text('reason_to_join')->nullable();
            $table->string('phone_number');
            $table->string('information_source')->nullable();
            $table->string('referral')->nullable();
            $table->string('occupation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn('training_ticket');
        });
    }
};
